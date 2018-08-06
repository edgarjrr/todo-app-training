<template>
    <div class="container">
        <div class="box">
            <div class="field is-grouped">
                <p class="control is-expanded">
                    <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="todoItemText">
                    <span class="text-danger" v-for="error in errors">@{{ error.text }}</span>
                </p>
                <p class="control">
                    <a class="button is-info" @click="addTodo">
                        Agregar
                    </a>
                </p>
            </div>
        </div>
        <table class="table is-bordered">
            <tr v-for="(todo, index) in items" :key="index">
                <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': todo.done }" @click="toggleDone(todo)">
                    {{ todo.text }}
                </td>
                <td class="is-narrow">
                    <!--a class="button is-danger is-small" @click="removeTodo(todo)">Eliminar</a-->
                    <a class="button is-danger is-small" @click="removeTodo(todo)">Eliminar</a>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */
    export default {
        data () {
            return {
                todoItemText: '',
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
            addTodo () {
                let url = 'todo';
                axios.post(url, {
                    text: this.todoItemText,
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
                let url = 'todo/'+todo.id;
                axios.delete(url).then(response => {
                    this.items = this.items.filter(item => item !== todo)
                });
            },
            toggleDone (todo) {
                let url = 'todo/'+todo.id;

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
