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
        props: ['id',
                'text',
                'done'
        ],

        methods: {
            toggleDone () {
                this.$store.dispatch('toggleDone',{id: this.id, done: this.done});
            },

            removeTodo () {
                this.$store.dispatch('removeTodo',{id: this.id});
            }
        }
    }
</script>
<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
