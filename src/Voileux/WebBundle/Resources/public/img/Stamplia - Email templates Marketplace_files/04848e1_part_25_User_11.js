// Generated by CoffeeScript 1.4.0
(function() {

  App.Model.User = App.Model.extend({
    namespace: "user",
    defaults: {
      id: null,
      name: ''
    },
    url: function() {
      if (this.get('id')) {
        return "" + App.urlRoot + "/users/" + (this.get('id'));
      } else {
        return "" + App.urlRoot + "/users";
      }
    }
  });

}).call(this);
