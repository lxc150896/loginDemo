<template>
    <div class="contacts">
        <div>
            <button type="button" class="btn btn-info" data-toggle="modal" :data-target="'#myModal'" @click="showAdd()">Add</button>
            <div v-bind:id="'myModal'" class="modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-model="titleUser">{{ titleUser }}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="error" v-if="errors.length">
                                <span v-for="error in errors">{{ error }}</span>
                            </div>
                            <label>name</label>
                            <input id="user-name" type="text" v-model="user.name" class="form-control">
                            <label>email</label>
                            <input id="user-email" type="email" v-model="user.email" class="form-control">
                            <label>password</label>
                            <input type="password" id="pass" v-model="user.password" minlength="4" required class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="text-user" class="btn btn-info" @click="isAdd ? addUser() : updateUser(user)">{{ titleButton }}</button>
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
            <tr v-for="(user, index) in users">
                <td><span>{{ user.name }}</span></td>
                <td><p>{{ user.email }}</p></td>
                <td><button type="button" class="btn btn-info" data-toggle="modal" :data-target="'#myModal'" @click="showAdd(false, user, index)">Edit</button></td>
                <td><button type="button" class="btn btn-danger" @click="deleteUser(user, index)">Delete</button></td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    id: '',
                    name: '',
                    email: '',
                    password: ''
                },
                users: [],
                errors: [],
                titleUser: '',
                titleButton: '',
                isAdd: true,
                index: '',
            }
        },
        mounted() {
            axios.get('/home/user')
            .then((response) => {
                this.users = response.data;
            });
        }, 
        methods: {
            addUser() {
                axios.post('/admin/home/add', {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password
                }).then(response => {
                    if (response.data.id != null) {
                        $('#myModal').modal('hide');
                        $('.modal-backdrop').remove();
                        this.users.push({
                            id: response.data.id,
                            name: response.data.name,
                            email: response.data.email
                        })
                    }
                    
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
            updateUser(user) {
                axios.put('/admin/home/update/' + user.id, {
                    name: user.name,
                    email: user.email,
                    password: user.password
                }).then(response => {
                    this.$set(this.users, this.index, {
                        name: response.data.name,
                        email: response.data.email,
                    });
                    $('#myModal').modal('hide');
                    $('.modal-backdrop').remove();
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
            deleteUser(user, index) {
                axios.delete('/admin/home/delete/' + user.id)
                .then(response => {
                    this.users.splice(index, 1);
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name;
                })
            },
            resetModel() {
                this.user.id = '';
                this.user.name = '';
                this.user.email = '';
                this.user.password = '';
            },
            showAdd(isAdd = true, contact = null, index = null) {
                if (!isAdd) {
                    this.isAdd = false;
                    this.titleUser = 'Edit user';
                    this.titleButton = 'Edit';
                    this.user.id = contact.id;
                    this.user.name = contact.name;
                    this.user.email = contact.email;
                    this.user.password = '******';
                    this.index = index;
                } else {
                    this.isAdd = true;
                    this.titleUser = 'Add user';
                    this.titleButton = 'Add';
                    this.resetModel();
                }
            },
        }
    }
</script>
