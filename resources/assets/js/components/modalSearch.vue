<template>
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalSearch">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Search {{ title }}</h3>
				</div>
				<div class="modal-body">
					<input
						class="form-control"
						placeholder="search" 
						v-model="searchToken"
						@keyup="loadSearch"
					>
					<div class="list-group">
						<div v-for="item in searchItems" :key="item.id">
							<router-link data-dismiss="modal" class="list-group-item" :to="`/clients/${item.id}`">
								<div class="row">
									<div class="col col-xs-8">
										<strong class="text-left">{{ item.name }}</strong>
									</div>
									<div class="col col-xs-4">
										{{ item.dni }}
									</div>
								</div>
							</router-link>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import toastr from 'toastr'
	import { get } from '../helpers/api'
	
	export default {
		data() {
			return {
				searchToken: '',
				searchItems: []
			}
		},
		props: {
			title: {
			    type: String,
			    default: null
            },
			url: {
				type: String,
				default: null
			}
		},
		methods: {
			loadSearch () {
				console.log(`${this.$props.url}/search?q=${this.searchToken}`)
				get(`${this.$props.url}/search?q=${this.searchToken}`)
					.then((res) => {
						this.searchItems = res.data.data
					})
					.catch((e) => {
						toastr.error(e.message)
					} )
			},
		}
	}
</script>
