
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('todo-component', require('./components/Todo.vue'));
Vue.component('todo-input', require('./components/TodoInput.vue'));
Vue.component('todo-item', require('./components/TodoItem.vue'));

const store = new Vuex.Store({
      state: {
        items: [],
      },
      
      mutations: {
        SET_TODOS (state, items) {
	      state.items = items
	    }
      },

      actions: {
      	getTodos ({commit}) {
            let url = 'todo';
            axios.get(url).then(response => {
                commit('SET_TODOS', response.data)
            });
        },

        addTodo ({commit,state},payload) {
            let url = 'todo';
            axios.post(url, {
                text: payload.text,
                done: 0
            }).then(response => {
            	store.dispatch('getTodos')
            }).catch(error => {
                //this.errors = error.response.data
            });
        },

        removeTodo ({commit,state},payload) {
            let url = 'todo/' + payload.id;
            axios.delete(url).then(response => {
                store.dispatch('getTodos')
            });
        },

        toggleDone ({commit,state},payload) {
            let url = 'todo/' + payload.id;

            axios.put(url, {
                done: !payload.done
            }).then(response => {
                store.dispatch('getTodos')
            });
        }
      },

      getters: {
        items(state) {
            return state.items
        }
      }
    });

const app = new Vue({
    el: '#app',
    store
});
