$(document).ready( function() {
var info = "<?php echo $input ?>";

for (var i = 0; i < info.length; i++) {
  makeobject(info[i]);
}
<?php echo $input ?>

});




$(document).on('click', '#add', function() {

makeobject();
});


$(document).on('click', '#minWord', function() {
  $(this).parent().remove();
});



function makeobject(param) {



  var platform = $('<div/>', {
      'class': 'platform',
  });


  var bak1 = $('<div/>');
  var bak2 = $('<div/>');
  var bak3 = $('<div/>');


  var headline1 = $('<div/>', {
      'class': 'col-md-4'
  });

  var textholder1 = $('<div/>', {
    'class': 'col-md-8'
  });

  var label1 = $('<p>Naam kind</p>', {
      'class': 'label'
  });

  var textbalk1 = $('<input/>', {
      'type': 'text',
      'class': 'savethis ' + 'floater',
      'name': 'naamkind',
      'value': param[0]
  });


  var headline2 = $('<div/>', {
      'class': 'col-md-4'
  });

  var textholder2 = $('<div/>', {
    'class': 'col-md-8'
  });

  var label2 = $('<p>Leeftijd</p>', {
      'class': 'label'
  });

  var textbalk2 = $('<input/>', {
      'type': 'text',
      'class': 'savethis ' + 'floater',
      'name': 'leeftijd',
      'value': param[1]
  });

  var headline3 = $('<div/>', {
      'class': 'col-md-4'
  });

  var textholder3 = $('<div/>', {
    'class': 'col-md-8'
  });

  var label3 = $('<p>Jongen/Meisje</p>', {
      'class': 'label',
      'value': ''
  });

  var textbalk3 = $('<input/>', {
      'type': 'text',
      'class': 'savethis ' + 'floater',
      'name': 'geslacht',
      'value': param[2]
  });


  var  Delete = $('<a id="minWord" class="min">Verwijderen</a>');

  $(textholder1).append(textbalk1);
  $(headline1).append(label1)
  $(bak1).append(headline1, textholder1);

  $(textholder2).append(textbalk2);
  $(headline2).append(label2)
  $(bak2).append(headline2, textholder2);

  $(textholder3).append(textbalk3);
  $(headline3).append(label3)
  $(bak3).append(headline3, textholder3);

  $(platform).append(bak1, bak2, bak3, Delete);

  $('#addhere').append(platform);

};
