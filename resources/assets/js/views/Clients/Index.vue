<template>
	<list-view
		title="Clients"
		url="/clients"
		resource="clients"
		:searchFields="searchFields"
		:listRows="listRows"
		:sortBy="sortBy"
		:buttons="buttons"
	/>
</template>

<script>
import listView from '../../components/listView'

export default {
  	components: {
		listView
	},
	data() {
		return {
			sortBy: 'name',
			searchFields: [
				{ 'field': 'name', 'class': 'col-xs-5'},
				{ 'field': 'dni', 'class': 'col-xs-5'}
			],
			listRows: [
					{ 
						'class': 'col',						
						'id': 1, 'showFields': [
							{ 'field': 'name'},
							{ 'field': 'dni'},
							{ 'field': 'birthday'},
						]
					},
					{ 
						'class': 'col d-none d-lg-block',
						'id': 2, 'showFields': [
							{ 'field': 'email'},	
						]
					},
					{ 
						'class': 'col d-none d-lg-block',
						'id': 3, 'showFields': [
							{ 'field': 'phone'}	
						]
					}
			],
			buttons: [
				{ 'id': 1, 'caption': 'policies', 'path': 'policies', 'field': 'policies_count'}
			]
		}
	}
}
</script>
