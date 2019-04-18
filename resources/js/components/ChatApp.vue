<template>
    <div class="chat-app">
        <UsersList/>
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsList :contacts="contacts" @selected="startConversationWith"/>
        <AddUserGroup/>
        <NewGroup :groups="groups" :user="user" @group="statusGroupId" :groupId="groupId"/>
    </div>
</template>

<script>
    import UsersList from './UsersList';
    import Conversation from './Conversation';
    import NewGroup from './NewGroup';
    import ContactsList from './ContactsList';
    import AddUserGroup from './AddUserGroup';
    export default {
        props: {
            user: {
                type:Object,
                required: true
            },
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                groups:[],
                groupId: 1,
            }
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
            .listen('NewMessage', (e) => {
                this.hanleIncoming(e.message);
            });
            Echo.private('users.' + this.user.id)
            .listen('GroupCreated', (e) => {
                this.saveGroups(e.group);
            });
            axios.get('/contacts')
            .then((response) => {
                this.contacts = response.data;
            });
            axios.get('/groups')
            .then((response) => {
                this.groups = response.data;
            });
        },
        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);
                axios.get(`/conversation/${contact.id}`)
                .then((response) => {
                    this.messages = response.data;
                    this.selectedContact = contact;
                })
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
                        single.unread += 1;
                    return single;
                })
            },
            saveGroups(group) {
                this.groups.push(group);
            },
            statusGroupId(group) {
                this.groupId = group.id;
            }
        },
        components: {Conversation, ContactsList, UsersList, NewGroup, AddUserGroup}
    }
</script>
