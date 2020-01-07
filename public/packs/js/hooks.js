class IncarnateHooks{
    /**
     * Registers a callback handler that is triggered when a hook is called
     *
     * @param {String} hook - the name of a hook
     * @param {Function} fun - the function to associate with a hook
     */
    static on(hook, fun){
        if (!IncarnateHooks._hooks[hook]){
            IncarnateHooks._hooks[hook] = [];
        }
        IncarnateHooks._hooks[hook].push(fun);
    }

    /**
     * Calls all hooks attached to a name
     * @param {String} hook - the name of a hook
     * @param {Array} args - an array of all remaining arguments
     */
    static callAll(hook, ...args){
        if (IncarnateHooks._hooks[hook]){
            IncarnateHooks._hooks[hook].forEach(fun =>{
                this.call(hook,fun,args);
            });
        }
    }

    /**
     * Calls an individual hook
     *
     * @param {String} hook - the name of a hook
     * @param {Function} fun - the stored function
     * @param {Array} args - the arguments of an array
     */
    static call(hook,fun,args){
        try{
            return fun(args);
        }catch(err){
            console.warn('Error thrown in hook: ${hook} for ${fun.name}');
        }
    }
}
IncarnateHooks._hooks = {};