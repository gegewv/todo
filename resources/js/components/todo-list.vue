<template>
    <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
        <div class="mb-4">
            <h1 class="text-grey-darkest">Todo List</h1>
            <div class="flex mt-4">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker" v-model="newTodo" @keyup.enter="addTodo" placeholder="Add Todo">
                <button class="flex-no-shrink p-2 border-2 rounded text-teal border-teal hover:text-white hover:bg-teal" @click="addTodo" :disabled="newTodo.length === 0">Add</button>
            </div>
        </div>
        <div class="max-h-screen-1/2 overflow-y-scroll">
            <todo-item v-for="(todo, index) in todos" :key="todo.id" :todo="todo" :index="index"></todo-item>
            <div v-show="todos.length === 0">
                <p class="w-full text-center text-grey-dark">There are no todos</p>
            </div>
        </div>
    </div>
</template>

<script>
    import todoItem from './todo-item'
    export default {
        data() {
            return{
                todos: [],
                newTodo: '',
            }
        },
        methods: {
            initListeners() {
                const t = this;

                // 监听 update-todo 事件
                bus.$on('update-todo', function (details) {
                    t.updateTodo(details);
                });

                // 监听remove-todo 事件
                bus.$on('remove-todo', function (details) {
                    t.removeTodo(details)
                })
            },
            getTodos() {
                const t = this;
                axios.get('/todos').then(({data}) => {
                    t.todos = data
                })
            },
            createTodo(text) {
                const t = this;

                axios.post('/todos', {text: text, finished: false}).then(({data}) => {
                    // unshift() 方法可向数组的开头添加一个或更多元素，并返回新的长度。
                    t.todos.unshift(data);
                })
            },
            updateTodo(details) {
                const t = this;
                axios.patch('/todos/'+details.id, details.data).then(({data}) => {
                    t.todos.splice(details.index, 1, data)
                })
            },
            removeTodo(details) {
                const t = this;
                axios.delete('/todos/'+details.id).then(() => {
                    t.todos.splice(details.index, 1)
                })
            },
            addTodo() {
                const t = this;

                if (t.newTodo.length > 0) {
                    t.createTodo(t.newTodo);
                    t.newTodo = '';
                }
            },
            updateStatus(todo) {
                todo.finished = !todo.finished;
            },
            remove(index) {
                const t = this;

                t.todos.splice(index, 1);
            }
        },
        created() {
            this.getTodos();
            this.initListeners();
        },
        components: {
            todoItem
        }
    }
</script>
