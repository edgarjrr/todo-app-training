<template>
    <tr>
        <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': done }" @click="toggleDone()">
            {{ text }}
        </td>
        <td class="is-narrow">
            <a class="button is-danger is-small" @click="removeTodo()">Eliminar</a>
        </td>
    </tr>
</template>
<script>
    export default {
        props: {
            id: Number,
            text: String,
            done: Boolean,
            todo: Object
        },

        methods: {
            toggleDone () {
                this.$emit('toDone', this.todo);
            },

            removeTodo () {
                this.$emit('delete', this.todo);
            }
        }
    }
</script>
<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
