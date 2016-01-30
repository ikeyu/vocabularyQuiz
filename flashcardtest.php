<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Quiz.php');

$quiz = new MyApp\Quiz();


if (!$quiz->isFinished()) {
  $data = $quiz->getCurrentQuiz();
  shuffle($data['choices']);
}
  // $answer = $quiz->checkAnswer;
  // var_dump( $_SESSION['current_num']);
  // var_dump( $_SESSION['correct_count']);
  $answerSheet =  $_SESSION['checkAnswer'];
  $score = $quiz->getScore();
  $totalQuizNum = $quiz->totalQuizNum();
  $numberOfRows = $totalQuizNum / 2;
  $i = 0;
    

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css">
  <!-- <link rel="shortcut icon" href="images/logofav.png" > -->
  <link href='https://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1 ,maximum-scale=1">
  <link rel="stylesheet" media="all" type="text/css" href="css/styles.css" /> 
  <!-- <link rel="stylesheet" media="all" type="text/css" href="css/tablet.css" /> -->
  <!-- <link rel="stylesheet" media="all" type="text/css" href="css/smart.css" /> -->
  <title>flashcard</title>
</head>
<body>
<div class="wrapper">
  <?php if ($quiz->isFinished()) : ?>
    <a href="">finished!</a>
      <div class="score"><?php echo $score; ?>点</div>

      <table class="scoreTable">
      <tr>
      <?php foreach ($answerSheet as $key => $answer) : ?>
        <?php if ($i != 0 && $i % 3 == 0) {echo "</tr><tr>";} $i++; ?>
        <td><?php echo $i; ?></td>
        <td><?php if ($key == $answer) {echo '<img src="mark_maru.svg" height="40px">';} else {echo '<img src="mark_batsu.svg" height="40px">';} ?></td>
        <td><img src="<?php echo 'zodiac/' . $key . '.svg'; ?>" height="100px"></td>
        <td></td>
      <?php endforeach; ?>
      </tr>      
      </table>
     

    <?php $quiz->reset(); ?>
  <?php else : ?>

    <div id="qArea">
        <div><img id="main" class="effectBtn" src=""><span></span></div>
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
      <table style="margin: 0 auto">
      <tr>
        <?php foreach ($data['choices'] as $choises) : ?>
        <td><img class="answer" name="<?php echo $choises; ?>" src="<?php echo 'zodiac/' . $choises . '.svg'; ?>" height="250px"></td>
        <?php endforeach; ?>
      </tr>      
      </table>
    </div>

</div><!--wrapper-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="flashcardQuiz.js"></script>
<?php endif; ?>
</body>
</html>
