<template>
    <div class="contacts">
        <div id="dropdown" class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Messages
                <UserList :contacts="contacts" @selected="startConversationWith"/>
            </button>
        </div>
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
            <tr v-for="(contact, index) in users">
                <td><span>{{ contact.name }}</span></td>
                <td><p>{{ contact.email }}</p></td>
                <td><button type="button" class="btn btn-info" data-toggle="modal" :data-target="'#myModal'" @click="showAdd(false, contact, index)">Edit</button></td>
                <td><button type="button" class="btn btn-danger" @click="deleteUser(contact, index)">Delete</button></td>
            </tr>
        </table>
        <Conversation :contact="selectedContact" :messages="messages" :avatar="avatar" @new="saveNewMessage"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import UserList from './UserList';
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
                selectedContact: null,
                messages: [],
                contacts: [],
                avatar:null,
            }
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.hanleIncoming(e.message);
                });

            axios.get('/admin/home/user')
            .then((response) => {
                this.users = response.data;
            });

            axios.get('/admin/home/contact')
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
            deleteUser(contact, index) {
                axios.delete('/admin/home/delete/' + contact.id)
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
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                axios.get(`/admin/home/conversation/${contact.id}`)
                .then((response) => {
                    this.messages = response.data;
                    this.selectedContact = contact;
                });
                axios.get(`/admin/home/avatar/${contact.id}`)
                .then((response) => {
                    this.avatar = response.data;
                });
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else 
                        single.unread +=1;

                    return single;
                })
            }
        },
        components: {UserList, Conversation}
    }
</script>
