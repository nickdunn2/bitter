'use strict';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var PostModel = Backbone.Model.extend({
    urlRoot: '/posts',
    idAttribute: 'id',

    defaults: {
        post_content: ''
    }
});

var PostsCollection = Backbone.Collection.extend({
    url: '/posts',
    model: PostModel,
    parse: function(resp) {
        return resp.data;
    }
});

var PostView = Backbone.View.extend({
    tagName: 'li',

    className: 'post',

    events: {
        'click h2': 'alertStatus'
    },

    template: _.template('<h2><%= post_content %></h2>'),

    render: function() {
        var attributes = this.model.toJSON();
        this.$el.html(this.template(attributes));
        return this;
    },

    alertStatus: function(e) {
        e.preventDefault();
        alert('Hey yeah! You clicked the h2!');
    }
});

var PostsView = Backbone.View.extend({
    initialize: function() {
        this.collection.on('add', this.addOne, this);
        this.collection.on('reset', this.addAll, this);
    },

    addOne: function(post) {
        var postView = new PostView({ model: post });
        this.$el.append(postView.render().el);
    },

    addAll: function() {
        this.collection.forEach(this.addOne, this);
    },

    render: function() {
        this.addAll();
    }
});