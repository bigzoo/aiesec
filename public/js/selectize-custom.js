var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
  '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';
var formatName = function(item) {
  return item.name
};
// var users = $.ajax({
//   async: false,
//   url: "/users",
//   cache: false
// });
$('#select-to').selectize({
  persist: false,
  maxItems: null,
  valueField: 'email',
  labelField: 'name',
  searchField: ['name', 'email'],
  sortField: [{
    field: 'name',
    direction: 'asc'
  }],
  options: [],
  // options: users.responseJSON,
  render: {
    item: function(item, escape) {
      var name = formatName(item);
      return '<div>' +
        (name ? '<span class="name">' + escape(name) + '</span>' : '') +
        (item.email ? '<span class="email"> ' + escape(item.email) + '</span>' : '') +
        '</div>';
    },
    option: function(item, escape) {
      var name = formatName(item);
      var label = name || item.email;
      var caption = name ? item.email : null;
      return '<div>' +
        '<span class="">' + escape(label) + '</span>' +
        (caption ? '  <span class="caption">(' + escape(caption) + ')</span>' : '') +
        '</div>';
    }
  },
  createFilter: function(input) {
    var regexpA = new RegExp('^' + REGEX_EMAIL + '$', 'i');
    var regexpB = new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i');
    return regexpA.test(input) || regexpB.test(input);
  },
  create: function(input) {
    if ((new RegExp('^' + REGEX_EMAIL + '$', 'i')).test(input)) {
      return {
        email: input
      };
    }
    var match = input.match(new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i'));
    if (match) {
      var name = $.trim(match[1]);
      var pos_space = name.indexOf(' ');
      return {
        email: match[2],
      };
    }
    alert('Invalid email address.');
    return false;
  }
});
