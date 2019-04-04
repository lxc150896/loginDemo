<template>
    <div class="conversation col-md-8 float-right">
        <MessagesFeed :contact="contact" :messages="messages" :avatar="avatar" @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';

    export default {
        props: {
            contact: {
                type: Object,
                default: null,
            },
            messages: {
                type: Array,
                default: []
            },
            avatar: Object,
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }

                axios.post('/admin/home/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            }
        },
        components: {MessagesFeed}
    }
</script>
