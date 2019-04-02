<template>
    <div class="contacts">
        <div>
            <button type="button" class="btn btn-info" data-toggle="modal" :data-target="'#myModal'">Add</button>
            <div class="susses" v-if="susses.length">
                <span v-for="suss in susses">{{ suss }}</span>
            </div>
            <div v-bind:id="'myModal'" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add user</h4>
                        </div>
                        <div class="modal-body">
                            <div class="error" v-if="errors.length">
                                <span v-for="error in errors">{{ error }}</span>
                            </div>
                            <form method="post">
                                <input id="user-name" type="text" v-model="user.name" class="form-control">
                                <input id="user-email" type="email" v-model="user.email" class="form-control">
                                <input type="password" id="pass" v-model="user.password" minlength="4" required class="form-control">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="text-user" class="btn btn-info" @click="addUser()">Edit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            <tr v-for="(contact, index) in contacts">
                <td><span>{{ contact.name }}</span></td>
                <td><p>{{ contact.email }}</p></td>
                <td><button type="button" class="btn btn-info" data-toggle="modal" :data-target="'#myModal'+contact.id">Edit</button></td>
                <td><button type="button" class="btn btn-danger" @click="deleteUser(contact, index)">Delete</button></td>

                <div v-bind:id="'myModal'+contact.id" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit user</h4>
                            </div>
                            <div class="modal-body">
                                <div class="error" v-if="errors.length">
                                    <span v-for="error in errors">{{ error }}</span>
                                </div>
                                <input id="user-name" type="text" name="name" class="form-control"  v-model="contact.name">
                                <input id="user-email" type="email" name="email" class="form-control" v-model="contact.email">
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="text-user" class="btn btn-info" @click="updateUser(contact)">Edit</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    password: ''
                },
                contacts: [],
                errors: [],
                susses: []
            }
        },
        mounted() {
            axios.get('/admin/home/user')
            .then((response) => {
                this.contacts = response.data;
            });
        }, 

        methods: {
            addUser() {
                axios.post('/admin/home/add', {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password
                }).then(response => {
                    $('#myModal').modal('hide');
                    $('.modal-backdrop').remove();
                    this.errors.push(response.data.result);
                    this.contacts.push({
                        id: this.user.id,
                        name: this.user.name,
                        email: this.user.email
                    })
                })
                .catch(error => {
                    this.errors = [];
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name);
                    }
                    if (error.response.data.errors.email) {
                        this.errors.push(error.response.data.errors.email);
                    }
                })
            },
            updateUser(contact) {
                var name = contact.name;
                var email = contact.email;
                axios.put('/admin/home/update/' + contact.id, {
                    name: contact.name,
                    email: contact.email
                }).then(response => {
                    $('#myModal' + contact.id).modal('hide');
                    $('.modal-backdrop').remove();
                    this.susses.push(response.data.result);
                })
                .catch(error => {
                    this.errors = []
                    if (error.response.data.errors.name) {
                        this.errors.push(error.response.data.errors.name);
                    }
                    if (error.response.data.errors.email) {
                        this.errors.push(error.response.data.errors.email);
                    }
                })
            },
            deleteUser(contact, index) {
                axios.delete('/admin/home/delete/' + contact.id)
                .then(response => {
                    this.susses.push(response.data.result);
                    this.contacts.splice(index, 1);
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name;
                })
            }
        }
    }
</script>
