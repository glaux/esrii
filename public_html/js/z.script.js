/**
 * Mobile navigation
 */
$(function(){
  $('[role=navigation] > ul').slicknav();
});



/**
 * Sponsor shuffle
 */
$(function () {
  var shuffle = document.querySelector('.logoshuffle');
  if (shuffle == null) { return; }

  for (var i = shuffle.children.length; i >= 0; i--) {
    shuffle.appendChild(shuffle.children[Math.random() * i | 0]);
  }
});

/**
 * Countdown clock
 * https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/
 */
$(function () {

  // ESRII start date
  var deadline = '2019-09-05T08:40+02:00';

  var clock = document.getElementById('clockdiv');
  var header = document.getElementById('countdown-header');
  if ( clock == null ) {return;}

  var timeinterval = setInterval(function () {
    var t = getTimeRemaining(deadline);

    console.log(t.diff);
    if (t.diff < 1) {
      clock.innerHTML = '';
      header.innerHTML = 'Welcome to the 6th esrii Conference!';
      return;
    }

    var daytext = t.days == 1 ? ' day, ' : ' days, ';
    var hourtext = t.hours == 1 ? ' hour, ' : ' hours, ';
    var minutetext = t.minutes == 1 ? ' minute and ' : ' minutes and ';
    var secondtext = t.seconds == 1 ? ' second!' : ' seconds!';
    clock.innerHTML = '<h2>' +
      t.days + daytext +
      t.hours + hourtext +
      t.minutes + minutetext +
      t.seconds + secondtext + '</h2>';
    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }, 1000);

  function getTimeRemaining(endtime) {
    var r = {};
    var t = Date.parse(new Date(endtime)) - Date.parse(new Date());
    r.diff = t;
    r.seconds = Math.floor((t / 1000) % 60);
    r.minutes = Math.floor((t / 1000 / 60) % 60);
    r.hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    r.days = Math.floor(t / (1000 * 60 * 60 * 24));
    return r;
  }

});
