import NotificationList from "./Notification/NotificationList";
import NotificationAdd from "./Notification/NotificationAdd";

export default [
    { path: '/'     , name: 'NotificationList', component: NotificationList ,  props: true},
    { path: '/add'  , name: 'NotificationAdd',  component: NotificationAdd,    props: true },
]
