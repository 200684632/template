const routes = [
	{
	    name: 'login',
	    path: '/login', 
	    component: require('~/components/backend/Login.vue'),
	    meta: {
	      requireUnAuth: true
	    }
	},
	{
		name: 'root',
    	path: '/', 
    	component: require('~/components/backend/Index.vue'),
	}
]

export default routes