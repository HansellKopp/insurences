<template>
	<div class="client-list">
		<div class="client-item" v-for="client in clients">
			<router-link class="client-inner" :to="`/clients/${client.id}`">
				<img :src="`/images/${client.image}`" v-if="client.image">
				<p class="client-name">{{client.name}}</p>
			</router-link>
		</div>
	</div>
</template>
<script type="text/javascript">
	import { get } from '../../helpers/api'
	export default {
		data() {
			return {
				clients: []
			}
		},
		created() {
			get('/api/clients')
				.then((res) => {
					this.clients = res.data.clients
				})
		}
	}
</script>
