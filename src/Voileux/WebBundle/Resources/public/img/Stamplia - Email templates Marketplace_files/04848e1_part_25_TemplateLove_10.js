// Generated by CoffeeScript 1.4.0
(function() {

  App.Model.TemplateLove = App.Model.extend({
    namespace: "love",
    url: function() {
      if (!this.get('template')) {
        throw Error("Template Love neeeds a template");
      }
      if (!App.user) {
        throw Error("Please login before loving a template");
      }
      if (this.get('id')) {
        return "" + App.urlRoot + "/users/" + App.user.id + "/templates/" + (this.get('template')) + "/loves/" + (this.get('id'));
      } else {
        return "" + App.urlRoot + "/users/" + App.user.id + "/templates/" + (this.get('template')) + "/loves";
      }
    }
  });

}).call(this);
