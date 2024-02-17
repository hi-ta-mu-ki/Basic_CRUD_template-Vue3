import { defineStore } from 'pinia'

export const useLoginState =defineStore('loginstate',{
    state:()=>({
        login:false,
        role:null
    }),
    actions:{
        setLogin(){
            this.login=true;
        },
        setLogout(){
            this.login=false;
        },
        setRole(role){
            this.role=role;
        },
        abandonRole(){
            this.role=null;
        },
    },
});