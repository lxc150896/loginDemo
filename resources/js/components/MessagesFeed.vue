<template>
    <div class="chat">
        <div class="card">
            <div class="card-header msg_head">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <div v-if="avatars">
                            <div v-for="avatar in avatars">
                                <img :src="contact ? contact.avatar : avatar.avatar" class="rounded-circle user_img">
                                <span class="online_icon offline"></span>
                            </div>
                        </div>
                        <div v-else>
                            <img src="https://devilsworkshop.org/files/2013/01/enlarged-facebook-profile-picture.jpg" class="rounded-circle user_img">
                            <span class="online_icon offline"></span>
                        </div>
                    </div>
                    <div class="user_info">
                        <span>{{ contact ? contact.name : 'Hello' }}</span>
                        <p>17 Messages</p>
                    </div>
                    <div class="video_cam">
                        <span><i class="fas fa-video"></i></span>
                        <span><i class="fas fa-phone"></i></span>
                    </div>
                </div>
                <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                <div class="action_menu">
                    <ul>
                        <li><i class="fas fa-user-circle"></i> View profile</li>
                        <li><i class="fas fa-users"></i> Add to close friends</li>
                        <li><i class="fas fa-plus"></i> Add to group</li>
                        <li><i class="fas fa-ban"></i> Block</li>
                    </ul>
                </div>
            </div>
            <div class="card-body msg_card_body" ref="feed">
                <div v-if="contact">
                    <div v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                        <div v-if="message.to != contact.id">
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img :src="contact.avatar" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer">
                                    {{ message.text }}
                                    <span class="msg_time">8:40 AM, Today</span>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    {{ message.text }}
                                    <span class="msg_time_send">8:55 AM, Today</span>
                                </div>
                                <div v-if="avatars" class="img_cont_msg">
                                    <div v-for="avatar in avatars">
                                        <img :src="avatar.avatar" class="rounded-circle user_img_msg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                    </div>
                    <textarea v-model="message" @keydown.enter="send" class="form-control type_msg" placeholder="Message ..."></textarea>
                    <div class="input-group-append">
                        <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            },
            avatars: {
                type: Array,
                default: []
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            },
            send(e) {
                e.preventDefault();
                if (this.message == '') {
                    return;
                }
                this.$emit('send', this.message);
                this.message = '';
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>
