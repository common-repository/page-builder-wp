function countdown() {
  var dateEnd = wpc_maintenance.dateEnd;
  var timer, days, hours, minutes, seconds;

  dateEnd = new Date(dateEnd);
  dateEnd = dateEnd.getTime();

  if (isNaN(dateEnd)) {
    return;
  }

  timer = setInterval(calculate, 1000);

  function calculate() {
    var dateStart = new Date();
    dateStart = new Date(
      dateStart.getUTCFullYear(),
      dateStart.getUTCMonth(),
      dateStart.getUTCDate(),
      dateStart.getUTCHours(),
      dateStart.getUTCMinutes(),
      dateStart.getUTCSeconds()
    );
    var timeRemaining = parseInt((dateEnd - dateStart.getTime()) / 1000);

    if (timeRemaining >= 0) {
      var countdownElement = document.querySelector('.countdown');
      if (countdownElement) {
        countdownElement.style.display = 'block';
      }

      days = parseInt(timeRemaining / 86400);
      timeRemaining = timeRemaining % 86400;
      hours = parseInt(timeRemaining / 3600);
      timeRemaining = timeRemaining % 3600;
      minutes = parseInt(timeRemaining / 60);
      timeRemaining = timeRemaining % 60;
      seconds = parseInt(timeRemaining);

      document.getElementById('days').innerHTML = parseInt(days, 10);
      document.getElementById('hours').innerHTML = ('0' + hours).slice(-2);
      document.getElementById('minutes').innerHTML = ('0' + minutes).slice(-2);
      document.getElementById('seconds').innerHTML = ('0' + seconds).slice(-2);
    } else {
      var countdownElement = document.querySelector('.countdown');
      if (countdownElement) {
        countdownElement.style.display = 'none';
      }
      clearInterval(timer);
    }
  }

  window.onload = function () {
    var preloader = document.querySelector('.preloader');
    if (preloader) {
      setTimeout(function () {
        preloader.style.display = 'none';
      }, 1000);
    }
  };

}

// Ensure the DOM is fully loaded before executing the countdown
document.addEventListener('DOMContentLoaded', function () {
  countdown();
});