// Generated by CoffeeScript 1.4.0
(function() {

  App.Model.UserPayment = App.Model.extend({
    namespace: "payment",
    url: function() {
      if (this.get('id')) {
        return "" + App.urlRoot + "/users/" + App.user.id + "/payments/" + (this.get('id'));
      } else {
        return "" + App.urlRoot + "/users/" + App.user.id + "/payments";
      }
    }
  });

  App.Model.UserPaymentCollection = App.Collection.extend({
    model: App.Model.UserPayment,
    namespace: "payments",
    fetched: null,
    url: function() {
      return "" + App.urlRoot + "/users/" + App.user.id + "/payments";
    }
  });

}).call(this);
