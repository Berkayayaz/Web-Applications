-- MAD-3144 ASSIGNMENT 
-- Group GINGER
-- Inserts sample data into the tables
-- version 1.0.0

--
-- Inserts sample data into `category` table:
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categoryDesc`, `thumbnail`, `status`) VALUES
(1, 'HTML', 'Web design and development with HTML', '', 0),
(2, 'Project Management', 'Project Management Professional Certification (PMP)', '', 0);

-- --------------------------------------------------------

--
-- Inserts sample data into `question` table:
--

INSERT INTO `question` (`questionID`, `categoryID`, `questionBody`, `optionA`, `optionB`, `optionC`, `optionD`, `answer`, `status`) VALUES
(1, 1, 'A webpage displays a picture. What tag was used to display that picture?', 'picture', 'image', 'img', 'src', 'C', 0),
(2, 1, '<b> tag makes the enclosed text bold. What is other tag to make text bold?', '<strong>', '<dar>', '<black>', '<emp>', 'A', 0),
(3, 1, 'Tags and test that are not directly displayed on the page are written in _____ section.', '<html>', '<head>', '<title>', '<body>', 'B', 0),
(4, 1, 'Which tag inserts a line horizontally on your web page?', '<hr>', '<line>', '<line direction=”horizontal”>', '<tr>', 'A', 0),
(5, 1, 'What should be the first tag in any HTML document?', '<head>', '<title>', '<html>', '<document>', 'C', 0),
(6, 1, 'Which tag allows you to add a row in a table?', '<td> and </td>', '<cr> and </cr>', '<th> and </th>', '<tr> and </tr>', 'D', 0),
(7, 1, 'How can you make a bulleted list?', '<list>', '<nl>', '<ul>', '<ol>', 'C', 0),
(8, 1, 'How can you make a numbered list?', '<dl>', '<ol>', '<list>', '<ul>', 'B', 0),
(9, 1, 'How can you make an e-mail link?', '<a href=”xxx@yyy”>', '<mail href=”xxx@yyy”>', '<mail>xxx@yyy</mail>', '<a href=”mailto:xxx@yyy”>', 'D', 0),
(10, 1, 'What is the correct HTML for making a hyperlink?', '<a href=”http:// mcqsets.com”>ICT Trends Quiz</a>', '<a name=”http://mcqsets.com”>ICT Trends Quiz</a>', '<http://mcqsets.com</a>', 'url=”http://mcqsets.com”>ICT Trends Quiz', 'A', 0),
(11, 1, 'Choose the correct HTML tag to make a text italic', '<ii>', '<italics>', '<italic>', '<i>', 'D', 0),
(12, 1, 'Choose the correct HTML tag to make a text bold?', '<b>', '<bold>', '<bb>', '<bld>', 'A', 0),
(13, 1, 'What is the correct HTML for adding a background color?', '<body color=”yellow”>', '<body bgcolor=”yellow”>', '<background>yellow</background>', '<body background=”yellow”>', 'B', 0),
(14, 1, 'Choose the correct HTML tag for the smallest size heading?', '<heading>', '<h6>', '<h1>', '<head>', 'B', 0),
(15, 1, 'What is the correct HTML tag for inserting a line break?', '<br>', '<lb>', '<break>', '<newline>', 'A', 0),
(16, 1, 'What does vlink attribute mean?', 'visited link', 'virtual link', 'very good link', 'active link', 'A', 0),
(17, 1, 'Which attribute is used to name an element uniquely?', 'class', 'id', 'dot', 'all of the above', 'B', 0),
(18, 1, 'Which tag creates a check box for a form in HTML?', '<checkbox>', '<input type=”checkbox”>', '<input=checkbox>', '<input checkbox>', 'B', 0),
(19, 1, 'To create a combo box (drop down box) which tag will you use?', '<select>', '<list>', '<input type=”dropdown”>', 'all of above', 'A', 0),
(20, 1, 'Which of the following is not a pair tag?', '<p>', '<u>', '<i>', '<img>', 'D', 0),
(21, 2, 'If a stakeholder has any questions about project deliverables, as the PM, you should direct him to the:', 'WBS', 'Project plan', 'Preliminary Scope statement', 'None of the above', 'A', 0),
(22, 2, 'Your construction project was damaged by an earthquake. Your contractor says that he cannot fulfil the terms of the contract due to a specific clause you both had signed in the contract. He is referring to the:', 'Force majeure clause', 'Fixed price clause', 'Contract obligation terms', 'None of the above', 'A', 0),
(23, 2, 'Your vendor has confirmed in writing that he will not be able to provide the products contracted to him, in the time mentioned in the contract. You can terminate the contract and sue for damages. This is a type of:', 'Minor breach', 'Anticipatory breach', 'Material breach', 'Fundamental breach ', 'B', 0),
(24, 2, 'As a PM, you manage multiple projects. One of your projects is over budget while the other is under budget. You decide to transfer money from the latter to the former and report both projects as within budget. This is against the PMI code of ethics and is called:', 'Unethical management', 'Budget tampering', 'Fraudulent reporting', 'Cost leveling', 'B', 0),
(25, 2, 'Your brother can influence bids in the vendor company that has been contracted for your project. You should:', 'Disclose the bid price that is most likely to give him an advantage when bidding', 'Reject other vendors and award him the contract', 'Refrain from the decision-making process and make a full disclosure to stakeholders and wait for their decision before you proceed', 'Hint to the stakeholders that your brother might be involved in bidding', 'C', 0),
(26, 2, 'A project you are managing is about to be completed. But there is a minor defect in the work produced by the contractor. You should:', 'Neglect the defect if it is trivial', 'Ask the contractor to fix according to SOW', 'Submit a new RFP', 'None of the above', 'B', 0),
(27, 2, 'As a PM, you have identified some low priority risks. You should:', 'Neglect them as they will mostly not occur', 'Add them to a watch list within the risk register', 'Plan detailed response plans', 'None of the above', 'B', 0),
(28, 2, 'ne of your team members''  A''s father was sick when you were in the planning stage of your project. A had informed you that he might have to leave to visit his father if the situation arose. You had planned for this and spoke to the functional manager of your group to provide a back-up resource, B to be used if necessary. Now, A has left to see his father and B is filling in for him. But B is taking more than expected time to get up to speed and this impacts project cost and schedule. This is an example of a', 'Residual risk', 'Secondary risk', 'Contingency plan', 'None of the above', 'B', 0),
(29, 2, 'To motivate your team, you decided to reward a team member who performed well. This hurt cohesion in the team. You should:', 'Reset award criteria', 'Modify reward strategy to be win-win for the team', 'Award only two people', 'Declare that there will be no rewards going forward', 'B', 0),
(30, 2, 'Your project uses a vendor who has completed 50% of the contracted work. You are unsure of how much to pay the vendor. You should refer to the:', 'Request for proposal', 'Contract', 'Response to bid', 'Statement of work', 'B', 0),
(31, 2, 'When estimating time for activities, a PM should:', 'Use the best guess and estimate for all activities as there will be changes anyways as the project progresses and more information becomes available', 'Involve people who will be doing the work to get estimates', 'Estimate for what the cost will allow and not include buffers', 'None of the above', 'B', 0),
(32, 2, 'When there are people from different countries and cultures in a team, the project management team should:', 'Neglect the cultural differences to work as a team', 'Deal with everyone the same way', 'Capitalize on cultural differences', 'Mentor each other', 'C', 0),
(33, 2, 'If your business sponsor has an important but minor change to the scope, and he requests that you make the change without having to process a change request, you should:', 'Accommodate the change as stakeholder satisfaction is key to project success', 'Refuse to make the change as the scope has been frozen', 'Ask the sponsor to work with your team member to implement the minor change and document the change', 'Request the client that the change management process be followed', 'D', 0),
(34, 2, 'If a stakeholder directly asks a team member to make changes and the team member accommodates it:', 'Admonish the team member during the team meeting so that other team members are also aware', 'Inform the stakeholder that he should not talk to your team member', 'Talk to the stakeholder and team member in private, and emphasize gently that the Integrated Change Control process should be followed', 'Pretend to not know about the change and let it happen', 'C', 0),
(35, 2, 'When your client is ready to accept the product your project has produced, you should:', 'Refer to the quality plan to see if the product meets specifications', 'Refer to project management plan', 'Obtain client sign off and follow administrative closure process', 'Let go off the project resources and assign them to other projects', 'C', 0),
(36, 2, 'Appreciating a team member''s good work in front of the team results in:', 'Jealousy among other team members and should be avoided ', 'Encouragement for the team member and motivation for other team members', 'Shouldn''t be done as it shows preference', 'None of the above', 'B', 0),
(37, 2, 'As the project manager of an important project, you learnt many helpful tools and tips. What should you do?', 'Keep them to yourself', 'Archive your learning in the project folder and share with other PMs', 'Sign a non-disclosure agreement', 'None of the above', 'B', 0),
(38, 2, 'You just found out that the company that you were planning to use in your project is known for being late in delivering their products that can lead to losses to the project. You decide to go with a different company to ______ the risk.', 'Mitigate', 'Reject', 'Transfer', 'Avoid', 'D', 0),
(39, 2, 'You are the project manager of a project that involves sensitive information. You are inviting bids from vendors for some tasks on this project. Since the winning vendor will have access to the sensitive information, you should:', 'Decide to drop the vendor and instead do the tasks using an internal team', 'Swear the vendor to secrecy', 'Ask the vendor to sign a non-disclosure agreement', 'Threaten to take the vendor to court', 'C', 0),
(40, 2, 'A project is behind schedule. Two senior resources are added to help speed up work. The result is (choose the best answer):', 'Project will be completed on time', 'Project cost will not increase ', 'Project may not be completed on time due to increased number of communication channels', 'None of the above', 'D', 0);

--
-- Samples for user table
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `gender`, `email`, `phone`, `address`, `password`, `isAdmin`, `status`) VALUES
(1, 'Vanessa', 'Mendoza', 'female', 'vans@gmail.com', '6415731580', '20 Stonehill Crt', '123', 0, 0),
(2, 'Mete', 'Cantimur', 'male', 'metecantimur@gmail.com', '6475735773', '20 Stonehill Crt', '123', 0, 0),
(3, 'Berkay', 'Ayaz', 'male', 'berkayayaz@gmail.com', '6415731580', '20 Stonehill Crt', '123', 0, 0);
