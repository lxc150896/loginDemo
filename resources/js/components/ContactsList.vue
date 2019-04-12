<template>
    <div class="contacts-list col-md-4 float-left">
        <div class="chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." name="" class="form-control search">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body">
                    <ul class="contacts">
                        <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <img :src="contact.avatar" class="rounded-circle user_img">
                                    <span class="online_icon offline" v-if="contact.unread"><div class="offline_text">{{ contact.unread }}</div></span>
                                </div>
                                <div class="user_info">
                                    <span>{{ contact.name }}</span>
                                    <p>{{ contact.email }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: [],
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread;
                }]).reverse();
            }
        }
    }
</script>
