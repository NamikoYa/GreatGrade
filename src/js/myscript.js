// when document ready
$(document).ready(function() {
  // click event, toggles editability of table
  $('#btn_edit_id').click(function() {
    if($('#btn_edit_id').text() == 'Edit List') {
      $('.grade_td').attr('contenteditable', 'true');
      $('#btn_edit_id').text('Save List');
    } else {
      $('.grade_td').attr('contenteditable', 'false');
      $('#btn_edit_id').text('Edit List');
      $('#form_table').submit();
    }
  });
});