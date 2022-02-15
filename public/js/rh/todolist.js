$(function () {
  $('.list-group.checked-list-box .list-group-item').each(function () {

    // Settings
    var $widget = $(this),
        $checkbox = $('<input type="checkbox" class="invisible" />'),
        color = ($widget.data('color') ? $widget.data('color') : "primary"),
        style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
        settings = {
            on: {
                icon: 'fa-check-square'
            },
            off: {
                icon: 'fa-square'
            }
        };

    $widget.css('cursor', 'pointer');
    $widget.append($checkbox);

    // Event Handlers
    $widget.on('click', function () {
        $checkbox.prop('checked', !$checkbox.is(':checked'));
        $checkbox.triggerHandler('change');
        updateDisplay();
    });
    // $checkbox.on('change', function () {
    //     updateDisplay();
    // });


    // Actions
    function updateDisplay() {
        var isChecked = $checkbox.is(':checked');

        // Set the button's state
        $widget.data('state', (isChecked) ? "on" : "off");

        // Set the button's icon
        $widget.find('#far')
            .removeClass()
            .addClass('far ' + settings[$widget.data('state')].icon);
        // Update the button's color
        if (isChecked) {
            $widget.addClass(style + color + ' active');
        } else {
            $widget.removeClass(style + color + ' active');
        }
        before_submit();
    }

    // Initialization
    function init() {

      if ($widget.data('checked') == true) {
          $checkbox.prop('checked', !$checkbox.is(':checked'));
      }

      updateDisplay();

        // Inject the icon if applicable
      if ($widget.find('.far').length == 0) {
            $widget.prepend('<i id="far" class="far ' + settings[$widget.data('state')].icon + '"></i>  ');
        }
      }
      init();
    });

  function before_submit() {
      var checkedItems = {}, counter = 0;
      $("#check-list-box li.active").each(function(idx, li) {
          checkedItems[counter] = $(li).val();
          counter++;
      });

      $('#todolist').val(JSON.stringify(checkedItems));
  }
});
