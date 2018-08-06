<template>
    <div class="container">
        <todo-input v-on:sendNewTodoText="addTodo($event)"></todo-input>
        <table class="table is-bordered">
            <todo-item v-for="(todo, index) in items" :todo="todo" :id="todo.id" :text="todo.text" :done="todo.done" v-on:toDone="toggleDone($event)" v-on:delete="removeTodo($event)"></todo-item>
        </table>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                newTodotext: '',
                items: [],
                errors: [],
            }
        },

        mounted () {
            let url = 'todo';
            axios.get(url).then(response => {
                this.items = response.data
            });
        },

        methods: {
            addTodo (todoText) {
                let url = 'todo';
                axios.post(url, {
                    text: todoText,
                    done: 0
                }).then(response => {
                    this.items.push(response.data);
                    this.todoItemText = '';
                    this.errors = [];
                }).catch(error => {
                    this.errors = error.response.data
                });
            },

            removeTodo (todo) {
                let url = 'todo/' + todo.id;
                axios.delete(url).then(response => {
                    this.items = this.items.filter(item => item !== todo)
                });
            },

            toggleDone (todo) {
                let url = 'todo/' + todo.id;

                axios.put(url, {
                    done: !todo.done
                }).then(response => {
                    todo.done = !todo.done
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
