<template>
    <div>
        <Head title="Welcome to Skeleton" />
        <h1 class="mb-8 text-3xl font-bold">Welcome to Skeleton</h1>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'

export default {
    components: {
        Head,
    },
    props: {
        filters: Object,
        users: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'put',
            }),
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/users', pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
    methods: {
        update() {
            this.form.post(`/users/${this.user.id}`, {
                onSuccess: () => this.form.reset('password', 'photo'),
            })
        },
        destroy() {
            if (confirm('Are you sure you want to delete this user?')) {
                this.$inertia.delete(`/users/${this.user.id}`)
            }
        },
        restore() {
            if (confirm('Are you sure you want to restore this user?')) {
                this.$inertia.put(`/users/${this.user.id}/restore`)
            }
        },
    },
}
</script>
