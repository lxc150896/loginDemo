<template>
    <div class="group">
        <input v-model="nameGroup" @keydown.enter="group" placeholder="name group" class="type_msg">
        <button type="button" class="btn btn-info" @click="group()">New Group</button>
        <div v-if="groups">
            <ul v-for="(group, index) in groups" :key="group.id" @click="selectGroup(group)" :class="{ 'selectedGroup': group == selectedGroup }">
                <i>{{ group.name }}</i>
            </ul>
        </div>
        <div class="card">
            <div class="card-header msg_head">
                <div class="d-flex bd-highlight">
                    <div class="user_info">
                        <span>{{ selectedGroup ? selectedGroup.name : 'Hello' }}</span>
                        <p>17 Messages</p>
                    </div>
                    <div class="video_cam">
                        <span><i class="fas fa-video"></i></span>
                        <span><i class="fas fa-phone"></i></span>
                        <span>

                            <input v-model="addUserGroup" @keydown.enter="clickAddUserGroup" placeholder="Add User...">
                            <div v-if="addUsers" class="dropdown">
                                <div id="myDropdown" class="dropdown-content">
                                    <ul v-for="(addUser, index) in addUsers">
                                        <li>{{ addUser.name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
                <div>
                    <span style="float: right;" id="action_menu_btn">Add</span>
                </div>
                
            </div>
            <div class="card-body msg_card_body" ref="feed">
                <div v-if="groupMessages">
                    <div v-for="groupMessage in groupMessages" :class="`groupMessage${groupMessage.to == user.id ? ' sent' : ' received'}`" :key="groupMessage.id">
                        <div v-if="groupMessage.user_id != user.id">
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">

                                </div>
                                <div class="msg_cotainer">
                                    {{ groupMessage.message }}
                                    <span class="msg_time">8:40 AM, Today</span>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    {{ groupMessage.message }}
                                    <span class="msg_time_send">8:55 AM, Today</span>
                                </div>
                                <div class="img_cont_msg">
                                    <div >

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <textarea v-model="messagaeGroup" @keydown.enter="sendMessageGroup" class="form-control type_msg" placeholder="Message ..."></textarea>
    </div>
</template>

<script>
    export default {
        props: {
            groups: {
                type: Array,
                default: [],
            },
            user: {
                type: Object,
            },
            groupId: Number,
        },
        data() {
            return {
                nameGroup: '',
                messagaeGroup: '',
                selectedGroup: [],
                groupMessages: [],
                addUserGroup: '',
                addUsers: [],
                selectedUserGroup: Object,
            }
        },
        mounted() {
            Echo.private('groups.' + this.groupId)
            .listen('NewMessageGroup', (e) => {
                this.groupMessages.push(e.conversation);
            });
        },
        methods: {
            group() {
                if (this.nameGroup == '') {
                    return;
                }
                axios.post('/groups', {
                    text: this.nameGroup
                }).then((response) => {
                    this.groups.push(response.data);
                })
                this.nameGroup = '';
            },
            sendMessageGroup() {
                if (this.messagaeGroup == '' || this.selectedGroup == '') {
                    return;
                }
                axios.put('/conversations/create', {
                    text: this.messagaeGroup,
                    id: this.selectedGroup.id
                }).then((response) => {
                    
                })
                this.messagaeGroup = '';
            },
            selectGroup(group) {
                this.selectedGroup = group;
                this.$emit('group', group);
                axios.post('/conversations', {
                    id: group.id
                }).then((response) => {
                    this.groupMessages = response.data;
                })
            },
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            },
            clickAddUserGroup() {
                console.log(this.selectedGroup);
                if (this.addUserGroup == '' || this.selectedGroup == '') {
                    return;
                }
                axios.post('admin/search/user', {
                    text: this.addUserGroup,
                }).then((response) => {
                    this.addUsers = response.data;
                })
            }
        },
        watch: {
            selectedGroup(selectedGroup) {
                this.scrollToBottom();
            },
            groupMessages(groupMessages) {
                this.scrollToBottom();
            }
        }
    }
</script>
