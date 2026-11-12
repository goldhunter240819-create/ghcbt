<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GHCBT Voice Diagnostic</title>
<style>
    body { font-family: monospace; background: #0f172a; color: #f1f5f9; padding: 40px; }
    h2 { color: #f59e0b; }
    .box { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 20px; margin: 15px 0; }
    .ok  { color: #10b981; }
    .err { color: #f43f5e; }
    .warn{ color: #f59e0b; }
    button { background: #06b6d4; border: none; color: white; padding: 12px 24px; border-radius: 8px; font-size: 14px; cursor: pointer; margin: 5px; font-weight: bold; }
    button:hover { background: #0891b2; }
    button.gold { background: #f59e0b; color: #0f172a; }
    select { background: #1e293b; color: #f1f5f9; border: 1px solid #334155; padding: 8px; border-radius: 8px; width: 100%; margin-top: 10px; }
    #log { background: #000; border-radius: 8px; padding: 15px; font-size: 12px; line-height: 1.8; min-height: 80px; color: #86efac; white-space: pre-wrap; }
</style>
</head>
<body>
<h2>🎙️ GHCBT Voice Diagnostic Tool</h2>
<p style="color:#64748b;">Buka halaman ini di browser yang sama dengan GHCBT Anda, lalu jalankan semua test di bawah.</p>

<div class="box">
    <b>1. Browser &amp; API Support Check</b>
    <div id="support-result" style="margin-top:10px;"></div>
</div>

<div class="box">
    <b>2. Available Voices</b>
    <div id="voice-count" style="margin-top:5px; color:#64748b;">Loading...</div>
    <select id="voice-list" size="5" style="margin-top:10px;"></select>
</div>

<div class="box">
    <b>3. Test Speak</b><br>
    <button onclick="testSpeak()">▶ Test Bicara (Voice Terpilih)</button>
    <button onclick="testSpeakDefault()" class="gold">▶ Test Bicara (Default)</button>
    <button onclick="stopAll()" style="background:#f43f5e;">⏹ Stop</button>
    <div id="speak-result" style="margin-top:10px;"></div>
</div>

<div class="box">
    <b>4. Diagnostic Log</b>
    <div id="log">Waiting for tests...\n</div>
</div>

<script>
var synth = window.speechSynthesis;
var voices = [];
var selectedVoice = null;

function log(msg, cls){
    var el = document.getElementById('log');
    var ts = new Date().toLocaleTimeString();
    el.textContent += '[' + ts + '] ' + msg + '\n';
    el.scrollTop = el.scrollHeight;
}

// 1. Support check
(function(){
    var el = document.getElementById('support-result');
    var lines = [];

    if(typeof SpeechSynthesisUtterance === 'undefined'){
        lines.push('<span class="err">❌ SpeechSynthesisUtterance: NOT SUPPORTED</span>');
    } else {
        lines.push('<span class="ok">✅ SpeechSynthesisUtterance: Supported</span>');
    }

    if(!window.speechSynthesis){
        lines.push('<span class="err">❌ window.speechSynthesis: NOT FOUND</span>');
    } else {
        lines.push('<span class="ok">✅ window.speechSynthesis: Found</span>');
    }

    lines.push('<span style="color:#94a3b8;">Browser: ' + navigator.userAgent.substring(0,80) + '...</span>');
    lines.push('<span style="color:#94a3b8;">Protocol: ' + location.protocol + ' (https required on some browsers)</span>');

    el.innerHTML = lines.join('<br>');

    log('Browser: ' + navigator.userAgent.substring(0,60) + '...');
    log('Protocol: ' + location.protocol);
    log('speechSynthesis: ' + (!!window.speechSynthesis ? 'YES' : 'NO'));
})();

// 2. Load voices
function loadVoices(){
    if(!synth) return;
    voices = synth.getVoices();
    var el = document.getElementById('voice-count');
    var sel = document.getElementById('voice-list');

    if(voices.length === 0){
        el.innerHTML = '<span class="warn">⚠️ Voices not loaded yet, retrying...</span>';
        setTimeout(loadVoices, 200);
        return;
    }

    el.innerHTML = '<span class="ok">✅ ' + voices.length + ' voices found</span>';
    log('Voices loaded: ' + voices.length);

    sel.innerHTML = '';
    voices.forEach(function(v, i){
        var opt = document.createElement('option');
        opt.value = i;
        opt.text = v.name + ' (' + v.lang + ')' + (v.default ? ' [DEFAULT]' : '');
        sel.appendChild(opt);
        if(i === 0) log('First voice: ' + v.name + ' / ' + v.lang);
    });
}

if(synth){
    if(synth.onvoiceschanged !== undefined){
        synth.onvoiceschanged = loadVoices;
    }
    loadVoices();
}

// 3. Test speak
function testSpeak(){
    if(!synth){ document.getElementById('speak-result').innerHTML = '<span class="err">❌ Not supported</span>'; return; }
    var sel = document.getElementById('voice-list');
    var idx = parseInt(sel.value) || 0;
    var voice = voices[idx];

    log('Testing voice: ' + (voice ? voice.name : 'none selected'));

    synth.cancel();
    setTimeout(function(){
        var utt = new SpeechSynthesisUtterance('Hello Commander. GHCBT voice system is operational.');
        if(voice) utt.voice = voice;
        utt.rate = 0.95;
        utt.pitch = 1.1;
        utt.volume = 1.0;

        utt.onstart  = function(){ document.getElementById('speak-result').innerHTML = '<span class="ok">🔊 Speaking...</span>'; log('STARTED speaking OK!'); };
        utt.onend    = function(){ document.getElementById('speak-result').innerHTML = '<span class="ok">✅ Speech completed!</span>'; log('ENDED successfully.'); };
        utt.onerror  = function(e){ document.getElementById('speak-result').innerHTML = '<span class="err">❌ Error: ' + e.error + '</span>'; log('ERROR: ' + e.error); };

        synth.speak(utt);
        log('synth.speak() called. pending: ' + synth.pending + ' speaking: ' + synth.speaking);
    }, 100);
}

function testSpeakDefault(){
    if(!synth){ return; }
    log('Testing with DEFAULT voice (no voice object set)');
    synth.cancel();
    setTimeout(function(){
        var utt = new SpeechSynthesisUtterance('GHCBT default voice test.');
        utt.onstart = function(){ log('DEFAULT: started'); };
        utt.onend   = function(){ log('DEFAULT: ended OK'); };
        utt.onerror = function(e){ log('DEFAULT ERROR: ' + e.error); };
        synth.speak(utt);
    }, 100);
}

function stopAll(){
    if(synth) synth.cancel();
    log('Stopped.');
}
</script>
</body>
</html>
