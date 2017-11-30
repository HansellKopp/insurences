<template>
	<div class="client-show">
		<div class="client-row">
			<div class="client-image">
				<div class="client-box">
					<img :src="`/images/${client.image}`" v-if="client.image">
				</div>
			</div>
			<div class="client-details">
				<div class="client-details_inner">
					<small>Submitted by: {{client.user.name}}</small>
					<h1 class="client-title">{{client.name}}</h1>
					<p class="client-description">{{client.description}}</p>
					<div v-if="authState.api_token && authState.user_id === client.user_id">
						<router-link :to="`/clients/${client.id}/edit`" class="btn btn-primary">
							Edit
						</router-link>
						<button class="btn btn-danger" @click="remove" :disabled="isRemoving">Delete</button>
					</div>
				</div>
			</div>
		</div>
		<div class="client-row">
			<div class="client-ingredients">
				<div class="client-box">
					<h3 class="client-sub_title">Ingredients</h3>
					<ul>
						<li v-for="ingredient in client.ingredients">
							<span>{{ingredient.name}}</span>
							<span>{{ingredient.qty}}</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Auth from '../../store/auth'
	import { get, del } from '../../helpers/api'
	export default {
		data() {
			return {
				authState: Auth.state,
				isRemoving: false,
				client: {
					user: {},
					ingredients: [],
					directions: []
				}
			}
		},
		created() {
			get(`/api/clients/${this.$route.params.id}`)
				.then((res) => {
					this.client = res.data.client
				})
		},
		methods: {
			remove() {
				this.isRemoving = false
				del(`/api/clients/${this.$route.params.id}`)
					.then((res) => {
						if(res.data.deleted) {
							toastr.success('You have successfully delete client.')
							this.$router.push('/')
						}
					})
			}
		}
	}
</script>
