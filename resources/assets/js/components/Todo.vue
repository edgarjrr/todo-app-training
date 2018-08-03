<template>
    <div class="container">
        <todo-input></todo-input>
        <table class="table is-bordered">
            <todo-item v-for="(todo, index) in items" :id="todo.id" :text="todo.text" :done="todo.done"></todo-item>
        </table>
    </div>
</template>

<script>
    export default {
        mounted () {
            this.$store.dispatch('getTodos')
        },

        computed: {
            items() {
                return this.$store.getters.items;
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
