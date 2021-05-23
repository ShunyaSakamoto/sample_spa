<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li :class="{disabled: current_page <= 1}"><a class="page-link" href="#" @click="change(1)">&laquo;</a></li>
                        <li :class="{disabled: current_page <= 1}"><a class="page-link" href="#" @click="change(current_page - 1)">&lt;</a></li>
                        <li v-for="page in pages" :key="page" :class="{active: page === current_page}">
                            <a class="page-link" href="#" @click="change(page)">{{ page }}</a>
                        </li>
                        <li :class="{disabled: current_page >= last_page}"><a class="page-link" href="#" @click="change(current_page + 1)">&gt;</a></li>
                        <li :class="{disabled: current_page >= last_page}"><a class="page-link" href="#" @click="change(last_page)">&raquo;</a></li>
                    </ul>
                </nav>
            </div>
            <div style="margin-top: 10px" class="col text-right">全 {{total}} 件中 {{from}} 〜 {{to}} 件表示</div>
        </div>
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Person In Charge</th>
                <th scope="col">Show</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(task, index) in tasks" :key="index">
                <th scope="row">{{ task.id }}</th>
                <td>{{ task.title }}</td>
                <td>{{ task.content }}</td>
                <td>{{ task.person_in_charge }}</td>
                <td>
                    <router-link v-bind:to="{name: 'task.show', params: {taskId: task.id}}">
                        <button class="btn btn-primary">Show</button>
                    </router-link>
                </td>
                <td>
                    <router-link v-bind:to="{name: 'task.edit', params: {taskId: task.id}}">
                        <button class="btn btn-success">Edit</button>
                    </router-link>
                </td>
                <td>
                    <button class="btn btn-danger" v-on:click="deleteTask(task.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                tasks: [],
                current_page: 1,
                last_page: 1,
                total: 1,
                from: 0,
                to: 0
            }
        },
        methods: {
            getTasks(page) {
                axios.get('/api/tasks?page=' + page)
                    .then((res) => {
                        this.tasks = res.data.data
                        this.current_page = res.data.current_page
                        this.last_page = res.data.last_page
                        this.total = res.data.total
                        this.from = res.data.from
                        this.to = res.data.to
                    })
            },
            change(page) {
                if (page >= 1 && page <= this.last_page) this.getTasks(page)
            },
            deleteTask(id) {
                axios.delete('api/tasks/' + id)
                    .then(() => {
                        this.getTasks();
                    });
            }
        },
        computed: {
            pages() {
                let start = _.max([this.current_page - 2, 1])
                let end = _.min([start + 5, this.last_page + 1])
                start = _.max([end - 5, 1])
                return _.range(start, end)
            }
        },
        mounted() {
            this.getTasks(1)
        }
    }
</script>
