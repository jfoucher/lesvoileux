// Generated by CoffeeScript 1.4.0
(function() {

  App.Model.Template = App.Model.extend({
    namespace: "template",
    defaults: {
      id: null,
      name: '',
      slug: null
    },
    url: function() {
      if (this.get('id')) {
        return "" + App.urlRoot + "/templates/" + (this.get('id'));
      } else if (this.get('slug')) {
        return "" + App.urlRoot + "/templates/" + (this.get('slug'));
      } else {
        return "" + App.urlRoot + "/templates";
      }
    }
  });

  App.Model.TemplateCollection = App.Collection.extend({
    model: App.Model.Template,
    namespace: "templates",
    fetched: null,
    category: null,
    paginator_core: {
      type: 'GET',
      dataType: 'json',
      url: function() {
        return "" + App.urlRoot + "/templates";
      }
    },
    paginator_ui: {
      firstPage: 1,
      currentPage: 1,
      perPage: App.perPage,
      totalPages: 10
    },
    server_api: function() {
      var ret;
      ret = {
        'per_page': function() {
          return this.perPage;
        },
        'page': function() {
          return this.currentPage;
        },
        'orderby': 'id',
        'format': 'json'
      };
      return ret;
    },
    parse: function(resp) {
      this.totalPages = resp.count;
      if (!this.namespace) {
        throw Error("a namespace property must be defined");
      }
      return resp[this.namespace];
    },
    initialize: function() {
      return this.fetched = $.Deferred();
    },
    fetch: function() {
      var _this = this;
      this.fetched = $.Deferred();
      return Backbone.Collection.prototype.fetch.apply(this, [
        {
          url: this.url()
        }
      ]).done(function() {
        return _this.fetched.resolve(_this);
      });
    },
    url: function() {
      if (this.category) {
        return "" + App.urlRoot + "/categories/" + (this.category.get('name')) + "/templates";
      } else {
        return "" + App.urlRoot + "/templates";
      }
    }
  });

}).call(this);
