<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Quiz.php');

$quiz = new MyApp\Quiz();

if (!$quiz->isFinished()) {
  $data = $quiz->getCurrentQuiz();
  $question = $data['question'];
  shuffle($data['choices']);
}

  $answerSheet =  $_SESSION['checkAnswer'];
  $score = $quiz->getScore();
  $totalQuizNum = $quiz->totalQuizNum();
  $i = 0;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css">
  <!-- <link rel="shortcut icon" href="images/logofav.png" > -->
  <link href='https://fonts.googleapis.com/css?family=Slackey' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1 ,maximum-scale=1">
  <link rel="stylesheet" media="all" type="text/css" href="css/styles.css" /> 
  <!-- <link rel="stylesheet" media="all" type="text/css" href="css/tablet.css" /> -->
  <!-- <link rel="stylesheet" media="all" type="text/css" href="css/smart.css" /> -->
  <title>flashcard</title>
</head>
<body>
<div class="wrapper">
  <div class="titleArea"><img src="logo.png" height="35px" class="logo"><span class="titleSpan">Digital English</span></div>
  <?php if ($quiz->isFinished()) : ?>

      <div id="eval">Very Good</div>

      <table class="scoreTable">
      <tr>
      <?php foreach ($answerSheet as $key => $answer) : ?>
        <?php if ($i != 0 && $i % 3 == 0) {echo "</tr><tr>";} $i++; ?>
        <td><?php echo $i; ?></td>
        <td><?php if ($key == $answer) {echo '<img src="mark_maru.svg" height="40px">';} else {echo '<img src="mark_batsu.svg" height="40px">';} ?></td>
        <td><img src="<?php echo 'zodiac/' . $key . '.svg'; ?>" height="80px"></td>
        <td></td>
      <?php endforeach; ?>
      </tr>      
      </table>
    <div class="bottom">
      <div class="circle-line">
      <div class="score">Score<span class="scoreLabel"><?php echo $score; ?></span></div>
      <div><a href="" class="btn">Try Again</a></div>
      <div><a href="" class="btn">Menu</a></div>
      </div>

    </div>

    <?php $quiz->reset(); ?>
  <?php else : ?>

    <div id="qArea">
        <div><img id="main" class="effectBtn" src="<?php echo 'zodiac/' . $question . '.svg'; ?>"><span></span></div>
        <div id="question"><?php echo $data['question']; ?></div>

      <div class="btnArea">
        <div id="playBtn" class="active"><img src="audio.svg"></div>
        <!-- <div id="nextBtn" class="active"><div id="next">&raquo;</div></div> -->
      </div>

      <div class="nav">
        <div id="alert"></div>
      </div>
    </div>
        <!-- <form action="" method="post"> -->
    <div class="choiceArea">
      <table style="margin: 0 auto" id="choices">
      <tr>
        <?php foreach ($data['choices'] as $choises) : ?>
        <td class="choiceImg"><img class="answer" name="<?php echo $choises; ?>" src="music.svg" height="200px"></td>
        <?php endforeach; ?>
      </tr>      
      </table>
    </div>

    <div class="bottom">
      <div class="circle-line">
        <?php for ($i = 0; $i < $totalQuizNum; $i++) {
          if ($i < $_SESSION['current_num']) {
            echo '<div class="circles"><div class="circle"></div><div class="line"></div></div>';
          } elseif ($i == $_SESSION['current_num']) {
            echo '<div class="circles"><div class="circle white"></div>';
          } else {
            echo '<div class="line"></div></div><div class="circles"><div class="circle gray"></div>';
          }
        } ?>
      </div>
    </div>
  <?php endif; ?>
</div><!--wrapper-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="flashcardQuizB.js"></script>

</body>
</html>
