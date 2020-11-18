<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body card-todoapp">
                        <section class="todoapp">
                            <header class="header">
                                <h1>{{ $t('sidebar.todos') }}</h1>
                                <input
                                    class="new-todo"
                                    autofocus
                                    autocomplete="off"
                                    :placeholder="$t('todos.placeholder')"
                                    v-model="newTodo"
                                    @keyup.enter="addTodo"
                                >
                            </header>
                            <section class="main" v-show="todos.length" v-cloak>
                                <input
                                    id="toggle-all"
                                    class="toggle-all"
                                    type="checkbox"
                                    v-model="allDone"
                                    @change="saveTodos"
                                >
                                <label for="toggle-all"></label>
                                <ul class="todo-list">
                                    <li
                                        v-for="todo in filteredTodos"
                                        class="todo"
                                        :key="todo.id"
                                        :class="{ completed: todo.completed, editing: todo == editedTodo }"
                                    >
                                        <div class="view">
                                            <input class="toggle" type="checkbox" v-model="todo.completed" @change="saveTodos">
                                            <label @dblclick="editTodo(todo)">{{ todo.title }}</label>
                                            <button class="destroy" @click="removeTodo(todo)"></button>
                                        </div>
                                        <input
                                            class="edit"
                                            type="text"
                                            v-model="todo.title"
                                            v-todo-focus="todo == editedTodo"
                                            @blur="doneEdit(todo)"
                                            @keyup.enter="doneEdit(todo)"
                                            @keyup.esc="cancelEdit(todo)"
                                        >
                                    </li>
                                </ul>
                            </section>
                            <footer class="footer" v-show="todos.length" v-cloak>
                                <span class="todo-count">
                                    <strong>{{ remaining }}</strong> {{ remaining | pluralize }} {{ $t('global.left') }}
                                </span>
                                <ul class="filters">
                                    <li>
                                        <a href="#/all" :class="{ selected: visibility == 'all' }">{{ $t('global.all') }}</a>
                                    </li>
                                    <li>
                                        <a href="#/active" :class="{ selected: visibility == 'active' }"> {{ $t('global.active') }} </a>
                                    </li>
                                    <li>
                                        <a href="#/completed" :class="{ selected: visibility == 'completed' }"> {{ $t('global.completed') }} </a>
                                    </li>
                                </ul>
                                <button
                                    class="clear-completed"
                                    @click="removeCompleted"
                                    v-show="todos.length > remaining"
                                >
                                {{ $t('global.clear_completed') }}
                                </button>
                            </footer>
                        </section>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- card -->
            </div>
            <!--/. container -->
        </section>
    </div>
</template>




<script>

import i18n from '../../../plugins/i18n.js' // localization

// visibility filters
var filters = {
    all: function(todos) {
        return todos;
    },
    active: function(todos) {
        return todos.filter(function(todo) {
        return !todo.completed;
        });
    },
    completed: function(todos) {
        return todos.filter(function(todo) {
        return todo.completed;
        });
    }
};
export default {
    data() {
        return {
            idPage: 'todos',
            urlGetData: '/note/todos',
            breadcrumb: [],
            todos: [],
            newTodo: "",
            editedTodo: null,
            visibility: "all"
        };
    },

  // watch todos change for localStorage persistence
    watch: {
        todos: {
            handler(todos) {
                // this.saveTodos(todos)
            },
            deep: true
        }
    },

    computed: {
        filteredTodos() {
            return filters[this.visibility](this.todos);
        },
        remaining() {
            return filters.active(this.todos).length;
        },
        allDone: {
            get() {
                return this.remaining === 0;
            },
            set(value) {
                this.todos.forEach(function(todo) {
                    todo.completed = value;
                });
            }
        }
    },

    methods: {
        addTodo() {
            var value = this.newTodo && this.newTodo.trim()
            if (!value) {
                return;
            }
            let length = this.todos.length
            this.todos.unshift({
                id: Math.floor(Math.random() * 10000),
                title: value,
                completed: false
            })
            this.newTodo = ""
            this.saveTodos()
        },

        removeTodo(todo) {
            this.todos.splice(this.todos.indexOf(todo), 1);
            this.saveTodos()
        },

        editTodo(todo) {
            this.beforeEditCache = todo.title;
            this.editedTodo = todo;
        },

        doneEdit(todo) {
            if (!this.editedTodo) {
                return;
            }
            this.editedTodo = null;
            todo.title = todo.title.trim();
            if (!todo.title) {
                this.removeTodo(todo);
            }
            this.saveTodos()
        },

        cancelEdit(todo) {
            this.editedTodo = null;
            todo.title = this.beforeEditCache;
        },

        removeCompleted() {
            this.todos = filters.active(this.todos)
            this.saveTodos()
        },

        getTodos() {
            axios.get(this.urlGetData).then(response => {
                if (response.status === 200) {
                    const data = response.data.data
                    if (typeof data === 'object') {
                        this.todos = JSON.parse(data.todos || "[]")
                    } else {
                        this.getTodos()
                    }
                }
            })
            .catch(() => {
                setTimeout(() => {
                    this.getTodos()
                }, 500)
            })
        },

        async saveTodos() {
            const data = {
                todos: JSON.stringify(this.todos)
            }
            await axios.put(this.urlGetData, data).then(response => {
                if (response.status === 200) {
                    toastMsg.fire({
                        icon: 'success',
                        title: i18n.t('todos.msg_success')
                    })
                }
            }).catch(response => {
                toastMsg.fire({
                    icon: 'error',
                    title: i18n.t('todos.msg_failed')
                })
            })
        }
    },

    filters: {
        pluralize(n) {
            return n === 1 ? i18n.t('global.item') : i18n.t('global.items');
        }
    },

    directives: {
        "todo-focus"(el, binding) {
            if (binding.value) {
                el.focus();
            }
        }
    },


    mounted() {
        const self = this
        this.breadcrumb = [
            {label: this.$t('sidebar.notes'), to: {name: 'notes-model'}},
            {label: this.$t('sidebar.todos'), active: true},
        ]

        this.getTodos()


        // handle routing
        function onHashChange() {
            var visibility = window.location.hash.replace(/#\/?/, "");
            if (filters[visibility]) {
                self.visibility = visibility;
            } else {
                window.location.hash = "";
                self.visibility = "all";
            }
        }

        window.addEventListener("hashchange", onHashChange);
        onHashChange();
    },

    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.todos')
        })
    }
};

</script>
