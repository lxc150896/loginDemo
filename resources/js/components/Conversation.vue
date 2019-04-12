<template>
	<div class="conversation col-md-8 float-right">
        <MessagesFeed :contact="contact" :messages="messages" :avatars="avatars" @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';

	export default {
        data() {
            return {
                avatars: []
            }
        },
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type:Array,
                default: []
            },
        },
        mounted() {
            axios.get('/avatars')
            .then((response) => {
                this.avatars = response.data;
            });
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }

                axios.post('/conversation/send', {
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
