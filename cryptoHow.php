<?php
include("inc/php/functions.php");

session_start();

head("Homepage");
?>

<body>
    <?php 
    mobileNav(); 
    HeaderFunction(); 
    ?>
    <div class="cryptoHowWhat">
        <h1>What is Cryptocurrency</h1>
        <p>
            Imagine cryptocurrency as a kind of digital money that you can use on the internet.
            It is not physical like coins or bills; it exists only online.
            You can use it to buy things, trade with people, or even save it, just like regular money.
        </p>
    </div>
    
    <h2>How Does Cryptocurrency Work?</h2>

    <div class="crytoHowHowWork">	
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

    <div class="cryptoHowBlockchain">
        <h3>2. Blockchain (Digital Ledger)</h3>
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

    <div class="cryptoHowTransactions">
        <h3>3. How Transactions Work</h3>
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

    <div class="cryptoHowSecurity">
        <h3>4. Security</h3>
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

    <div class="cryptoHowMining">
        <h3>5. Mining (Creating New Coins)</h3>
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
    
    <div class="cryptoHowWhy">
        <h3>6. Why Use Cryptocurrency?</h3>
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

    <div class="cryptoHowWhere">
        <h3>7. Where to Keep Cryptocurrency?</h3>
        <p>
            You keep your cryptocurrency in a <strong>digital wallet</strong>, 
            which can be an app on your phone or computer. Just like a real wallet, 
            it holds your money and allows you to send and receive cryptocurrency.
        </p>
    </div>

    <div class="cryptoHowSummary">
        <h3>Summary</h3>
        <p>
            Cryptocurrency is online money that you can use just like regular money but without needing a bank. 
            It is secure, fast, and managed by a network of users instead of a single organization.
        </p>
    </div>

    <div class="teamFooter">
        <?php 
        footer();
        ?>
    </div>
</body