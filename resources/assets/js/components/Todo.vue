<template>
    <div class="container">
        <todo-input v-on:sendNewTodoText="addTodo($event)"></todo-input>
        <table class="table is-bordered">
            <todo-item v-for="(todo, index) in items" :id="todo.id" :text="todo.text" :done="todo.done" v-on:toDone="toggleDone($event)" v-on:delete="removeTodo($event)"></todo-item>
        </table>
    </div>
</template>

<script>
    export default {
        created () {
            this.getTodos();
        },

        data () {
            return {
                newTodotext: '',
                items: [],
                errors: [],
            }
        },

        methods: {
            getTodos () {
                let url = 'todo';
                axios.get(url).then(response => {
                    this.items = response.data
                });
            },

            addTodo (todoText) {
                let url = 'todo';
                axios.post(url, {
                    text: todoText,
                    done: 0
                }).then(response => {
                    this.getTodos();
                    this.todoItemText = '';
                    this.errors = [];
                }).catch(error => {
                    this.errors = error.response.data
                });
            },

            removeTodo (id) {
                let url = 'todo/' + id;
                axios.delete(url).then(response => {
                    this.getTodos();
                });
            },

            toggleDone (todo) {
                let url = 'todo/' + todo[0];

                axios.put(url, {
                    done: !todo[1]
                }).then(response => {
                    this.getTodos();
                });
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
