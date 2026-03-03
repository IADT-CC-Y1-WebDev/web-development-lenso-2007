import BankAccount from "./BankAccount.js";

class SavingsAccount extends BankAccount {

        constructor(_num, _name, _bal, _rate) {
        super(_name, _age, _bal);
    }

    toString(){
        return `
        Account: ${this.number}
        Name: ${this.name}
        Balance: ${this.balance}
        `;
    }
}

export default SavingsAccount;