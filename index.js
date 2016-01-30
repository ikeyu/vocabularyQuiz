
$(function(){

  'use strict';

  var voices;
  var audio = new Audio();
  audio.src = "seikai.mp3";
  var play = document.getElementById('playBtn');
  // var question = document.getElementById('question').innerHTML;
  var utterance = new SpeechSynthesisUtterance();
      utterance.volume = 1;
      utterance.rate = 1;
      utterance.pitch = 1;
      utterance.lang = 'en-US';

  var soundPlay = function(word){
    audio.src = word + ".mp3";
    audio.play();
  }

  var loadVoices = function() {
    voices = speechSynthesis.getVoices();
  }

  var robotVoice = function (word){
    loadVoices();
    utterance.voice = voices[3];
    utterance.text = word;      
    speechSynthesis.speak(utterance);
  }




});