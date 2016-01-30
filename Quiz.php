<?php

namespace MyApp;

class Quiz {
  private $_quizSet;

  public function __construct() {
    $this->_setup();
    if (!isset($_SESSION['current_num'])) {
      $_SESSION['current_num'] = 0;
      $_SESSION['correct_count'] = 0;
      $_SESSION['checkAnswer'];
    }
  }

  public function totalQuizNum(){
    return count($this->_quizSet);
  }

  public function addCurrentNum() {
    $correctAnswer = $this->_quizSet[$_SESSION['current_num']]['question'];
    if ($correctAnswer === $_POST['answer']) {
      $_SESSION['correct_count']++;
    }
    $_SESSION['current_num']++;
    $checkAnswer = $_SESSION['checkAnswer'];
    $checkAnswer[$correctAnswer] = $_POST['answer'];
    $_SESSION['checkAnswer'] = $checkAnswer;
  }

  public function isFinished() {
    return count($this->_quizSet) === $_SESSION['current_num'];
  }

  public function getScore() {
    return round($_SESSION['correct_count'] / count($this->_quizSet) * 100);
  }

  public function reset() {
    $_SESSION['current_num'] = 0;
    $_SESSION['correct_count'] = 0;
    $_SESSION['checkAnswer'] = null;
  }

  public function getAllQuiz() {
    return $this->_quizSet;
  }


  public function getCurrentQuiz() {
    return $this->_quizSet[$_SESSION['current_num']];
  }

  private function _setup() {
    $this->_quizSet[] = [
      "question" => "mouse",
      "choices"  => ["mouse","cow","tiger"]
    ];

    $this->_quizSet[] = [
      "question" => "cow",
      "choices"  => ["cow","tiger","rabbit"]
    ];

    $this->_quizSet[] = [
      "question" => "tiger",
      "choices"  => ["tiger","rabbit","dragon"]
    ];

    $this->_quizSet[] = [
      "question" => "rabbit",
      "choices"  => ["rabbit","dragon","snake"]
    ];

    $this->_quizSet[] = [
      "question" => "dragon",
      "choices"  => ["dragon","snake","horse"]
    ];

    $this->_quizSet[] = [
      "question" => "snake",
      "choices"  => ["snake","horse","sheep"]
    ];

    $this->_quizSet[] = [
      "question" => "horse",
      "choices"  => ["horse","sheep","monkey"]
    ];

    $this->_quizSet[] = [
      "question" => "sheep",
      "choices"  => ["sheep","monkey","bird"]
    ];

    $this->_quizSet[] = [
      "question" => "monkey",
      "choices"  => ["monkey","bird","dog"]
    ];

    $this->_quizSet[] = [
      "question" => "bird",
      "choices"  => ["bird","dog","mouse"]
    ];

    $this->_quizSet[] = [
      "question" => "dog",
      "choices"  => ["dog","pig","mouse"]
    ];

    $this->_quizSet[] = [
      "question" => "pig",
      "choices"  => ["pig","cow","mouse"]
    ];

  }
}