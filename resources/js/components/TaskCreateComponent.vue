<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form v-on:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">   
                            <input type="text" :class="inputClass.title" id="title" v-model="task.title" autocomplete="Off">
                            <span v-if="validationErrors.title != null" class="invalid-feedback" role="alert">
                                <strong>{{ validationErrors.title[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-3 col-form-label">Content</label>
                        <div class="col-sm-9">
                            <input type="text" :class="inputClass.content" id="content" v-model="task.content">
                            <span v-if="validationErrors.content != null" class="invalid-feedback" role="alert">
                                <strong>{{ validationErrors.content[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="person-in-charge" class="col-sm-3 col-form-label">Person In Charge</label>
                        <div class="col-sm-9">
                            <input type="text" :class="inputClass.person_in_charge" id="person-in-charge" v-model="task.person_in_charge">
                            <span v-if="validationErrors.person_in_charge != null" class="invalid-feedback" role="alert">
                                <strong>{{ validationErrors.person_in_charge[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                inputClass: {
                    title: 'form-control',
                    content: 'form-control',
                    person_in_charge: 'form-control'
                },
                task: {},
                validationErrors: {}
            }
        },
        methods: {
            submit() {
                axios.post('/api/tasks', this.task)
                    .then((res) => {
                        this.$router.push({name: 'task.list'});
                    })
                    .catch((e) => {
                        this.validationErrors = e.response.data.errors;

                        if (e.response.data.errors.title == null) {
                            this.inputClass.title = 'form-control';
                        } else {
                            this.inputClass.title = 'form-control is-invalid';
                        }
                        if (e.response.data.errors.content == null) {
                            this.inputClass.content = 'form-control';
                        } else {
                            this.inputClass.content = 'form-control is-invalid';
                        }
                        if (e.response.data.errors.person_in_charge == null) {
                            this.inputClass.person_in_charge = 'form-control';
                        } else {
                            this.inputClass.person_in_charge = 'form-control is-invalid';
                        }
                    });
            }
        }
    }
</script>