$(document).ready(function() {

});

function invokeForm(path, parameters) {
  var form = $('<form></form>');

  form.attr("method", "post");
  form.attr("action", path);

  $.each(parameters, function(key, value) {
    var field = $('<input></input>');

    field.attr("type", "hidden");
    field.attr("name", key);
    field.attr("value", value);

    form.append(field);
  });

  // The form needs to be a part of the document in
  // order for us to be able to submit it.
  $(document.body).append(form);
  form.submit();
}

/**
 * [appendToEl description]
 * @param  {[type]} el            example: $(this)
 * @param  {[type]} thingToAppend [description]
 * @return {[type]}               [description]
 */
function appendToEl(el, thingToAppend) {
  el.empty();
  el.append(thingToAppend);
}
