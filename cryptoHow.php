<?php
include("inc/php/functions.php");

session_start();

head("How");
mobileNav();
HeaderFunction();
?>

<body>
    <div class="container">
        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header">
                    What is Cryptocurrency
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>

                </div>
                <div class="accordion-content">
                    <p>
                        Imagine cryptocurrency as a kind of digital money that you can use on the internet.
                        It is not physical like coins or bills; it exists only online.
                        You can use it to buy things, trade with people, or even save it, just like regular money.
                    </p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    How Does Cryptocurrency Work?
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <h3>1. Digital Money</h3>
                    <ul>
                        <li>
                            <strong>Online Only: </strong>
                            Cryptocurrency is not something you can hold in your hand.
                            It is like online money you can use from your computer or phone.
                        </li>
                        <li>
                            <strong>Examples: </strong>
                            Bitcoin and Ethereum are popular types of cryptocurrency.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    Blockchain (Digital Ledger)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p>
                        Think of a <strong>blockchain</strong> as a special kind of digital
                        notebook that keeps a secure record of all transactions (who sent money to whom).
                    </p>
                    <ul>
                        <li>
                            <strong>Blocks: </strong>
                            Each page in this notebook is called a "block" and contains a list of transactions.
                        </li>
                        <li>
                            <strong>Chain: </strong>
                            These blocks are linked together in a chain, forming a complete record of all transactions.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    How Transactions Work
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p>Imagine you want to send digital money to a friend:</p>
                    <ul>
                        <li>
                            <strong>Your Digital Wallet: </strong>
                            You have a digital wallet (like an online bank account) that holds your cryptocurrency.
                        </li>
                        <li>
                            <strong>Sending Money: </strong>
                            You send your friend some cryptocurrency from your wallet.
                        </li>
                        <li>
                            <strong>Verification: </strong>
                            The transaction gets verified by the network to ensure you have enough funds and have not spent the same money twice.
                        </li>
                        <li>
                            <strong>Recorded: </strong>
                            Once verified, this transaction is added to the blockchain, just like writing it down in the digital notebook.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    Security
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p>Cryptocurrency uses special codes and techniques (called cryptography) to keep everything secure:</p>
                    <ul>
                        <li>
                            <strong>Public Key: </strong>
                            Like an email address that others use to send you money.
                        </li>
                        <li>
                            <strong>Private Key: </strong>
                            Like a password that you use to send money to others.
                            You need to keep this safe and secret.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    Mining (Creating New Coins)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <ul>
                        <li>
                            <strong>Puzzle Solvers: </strong>
                            People (called miners) use powerful computers to solve complex puzzles.
                        </li>
                        <li>
                            <strong>Reward: </strong>
                            When they solve a puzzle,
                            they get to add a new block to the blockchain and are rewarded with some new cryptocurrency.
                            This is how new coins are created.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    Why Use Cryptocurrency?
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <ul>
                        <li>
                            <strong>Fast and Easy: </strong>
                            You can send money to anyone, anywhere in the world,
                            quickly and usually with low fees.
                        </li>
                        <li>
                            <strong>Privacy: </strong>
                            You do not need to share as much personal information as with traditional banks.
                        </li>
                        <li>
                            <strong>Decentralized: </strong>
                            No single person or organization controls the cryptocurrency.
                            It is managed by everyone who uses it.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    Where to Keep Cryptocurrency?
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="accordion-header-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
                    </svg>
                </div>
                <div class="accordion-content">
                    <p>
                        You keep your cryptocurrency in a <strong>digital wallet</strong>,
                        which can be an app on your phone or computer. Just like a real wallet,
                        it holds your money and allows you to send and receive cryptocurrency.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>