$(function () {
  console.log("jQuery is ready!");
  // Xử lý click cho các menu có flyout
  $('.relative button').on('click', function (e) {
    e.preventDefault();
    const $parent = $(this).closest('.relative');
    const $flyout = $parent.find('.absolute');
    const $otherFlyouts = $('.relative').not($parent).find('.absolute');

    // Đóng tất cả các flyout khác
    $otherFlyouts.removeClass('opacity-100 translate-y-0')
      .addClass('opacity-0 translate-y-1')
      .delay(150)
      .queue(function (next) {
        $(this).css('display', 'none');
        next();
      });

    // Toggle flyout hiện tại
    if ($flyout.css('display') === 'none') {
      // Mở flyout
      $flyout.css('display', 'block')
        .removeClass('opacity-0 translate-y-1')
        .addClass('opacity-100 translate-y-0');
    } else {
      // Đóng flyout
      $flyout.removeClass('opacity-100 translate-y-0')
        .addClass('opacity-0 translate-y-1')
        .delay(150)
        .queue(function (next) {
          $(this).css('display', 'none');
          next();
        });
    }
  });

  // Đóng flyout khi click ra ngoài
  $(document).on('click', function (e) {
    if (!$(e.target).closest('.relative').length) {
      $('.absolute').removeClass('opacity-100 translate-y-0')
        .addClass('opacity-0 translate-y-1')
        .delay(150)
        .queue(function (next) {
          $(this).css('display', 'none');
          next();
        });
    }
  });
});