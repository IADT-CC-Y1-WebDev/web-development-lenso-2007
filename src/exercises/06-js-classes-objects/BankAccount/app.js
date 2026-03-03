import BankAccount from "./classes/BankAccount";
import SavingsAccount from "./classes/SavingsAccount";

bank = new BankAccount("1111111111", "Alice", 100.00);
savings = new SavingsAccount("2222222222", "Bob", 500.00, 0.05);

console.log(bank);
console.log(savings);