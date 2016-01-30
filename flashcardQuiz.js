
$(function(){

  'use strict';

  var voices;
  var audio = new Audio();
  // audio.src = "seikai.mp3";
  var play = document.getElementById('playBtn');
  var next = document.getElementById('nextBtn');
  var question = document.getElementById('question').innerHTML;
  var utterance = new SpeechSynthesisUtterance();
      utterance.volume = 1;
      utterance.rate = 1;
      utterance.pitch = 1;
      utterance.lang = 'en-US';

  var soundPlay = function(word){
    audio.src = word + ".mp3";
    audio.play();
    audio.onended = function(){  
    }
  }

  var loadVoices = function() {
    voices = speechSynthesis.getVoices();
  }
 
  var playActive = function(){
    $('#playBtn').removeClass('disabled');
    $('#playBtn').addClass('active');    
  }


  // voices[19] = trinose

  var robotVoice = function (word){
    loadVoices();
    utterance.voice = voices[3];
    utterance.text = word;      
    speechSynthesis.speak(utterance);
  }

  var bothActive = function(){
    $('.answer').removeClass('disabled');
    $('#playBtn').removeClass('disabled');
  }

  var bothDisabled = function(){
    $('.answer').addClass('disabled');    
    $('#playBtn').addClass('disabled');
  }


  var quizSpeech = function(word){
      utterance.text = word;      
      speechSynthesis.speak(utterance);
  }

  var seikai = function(word){
    utterance.text = word;      
    speechSynthesis.speak(utterance);
    utterance.onend = function(){
    soundPlay("seikai");
    }
  }


  var answer;

  //answer の check
  $('.answer').on('click', function() {

    if($('.answer').hasClass('disabled')) {
      return
    }

    bothDisabled();
    var selected = $(this);
    answer = selected[0].name;
    selected.addClass('click');
    quizSpeech(answer);
    utterance.onend = function(){
      if (question == answer) {
        soundPlay("seikai");
        setTimeout(robotVoice, 800, "good");
        utterance.onend = function(){
          setTimeout(nextQuestion, 1000);
        }
      } else {
        soundPlay("zannen");
        setTimeout(robotVoice, 500, "oh oh");
        utterance.onend = function(){
          setTimeout(nextQuestion, 1000);
        }
      }    
      console.log(answer);
    }

  });

  var nextQuestion = function() {
    $.post('_next.php', {
       answer: answer
    }).done(function() {
      console.log();
      location.reload();
    });
  }

  var speakOut = function() {
    loadVoices();
    utterance.voice = voices[1];
    utterance.text = question;
    speechSynthesis.speak(utterance);
  }

  $('#playBtn').on('click',function(){
    playOnce();
  });

  var playOnce = function() {
    // ボタンがすでに押されているか、問題が取得できてない場合
    if($('#playBtn').hasClass('disabled')) {
      return
    }
    bothDisabled()
    $('.effectBtn').addClass('click');
    setTimeout(speakOut, 500);
    setTimeout(removeEffect, 1600);
    setTimeout(bothActive, 1600);
  }

  var init = function (){
    loadVoices();
    utterance.volume = 0;
    utterance.text = 'page loaded';
    speechSynthesis.speak(utterance);
    utterance.onend = function(){
    utterance.volume = 1;
    playOnce();
    }
  }

  init();

  console.log(voices);

  var removeEffect = function() {
    $('.effectBtn').removeClass('click');
  }

 });