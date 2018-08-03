<template>
    <div class="box">
        <div class="field is-grouped">
            <p class="control is-expanded">
                <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="todoItemText">
            </p>
            <p class="control">
                <a class="button is-info" @click="newTodo">
                    Agregar
                </a>
            </p>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                todoItemText: ''
            }
        },
        methods: {
            newTodo () {
              if(this.todoItemText != '') {
                this.$store.dispatch('addTodo',{text: this.todoItemText});
                this.todoItemText = '';
              } else
                alert('Debes escribir un recordatorio');
            }
        }
    }
</script>
