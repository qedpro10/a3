Assignment #3
This is a rudimentary Star Trek Trivia game.  I chose it so that I could
practice moving from page to page and get a better understanding of Laravel views.

The main page displays the Star Trek Federation emblem and provides a place
where the user can select the game they want to play.  There are 3 options:
1. Pulldown list of Star Trek Series categories (The Original Series, The Next Generation,
    Deep Space Nine, Voyager and Enterprise).  The user must select one.
    If the user fails to select a category, then the "Required" output
    is highlighted in red.
2. Choice between impulse and warp radio buttons
      impulse is a leisure game that is not timed. (default)
      warp provides the time in seconds for how long it took to complete the quiz
3. I'm a Trekkie checkbox.  This indicates that you think you know your Star Trek
so the questions are going to be harder. Note right now it redirects to another set
of questions, but these questions are essentially the same as the easy questions
because I just didn't have the time to create such a huge database.  But the
hookup is there such that it will look at a different set of questions.
By default it is not checked.

Once the user has setup their game, they select the "Engage" button which directs
them to game page which shows the first question.  The game page is tailored to
the category selected and shows a picture of the Star Trek series selected.

Each time the user selects the answer and clicks on the submit butto, the program
updates the score and then presents a new question.  When all 10 (default)  questions
have been answered the user is directed to the score page to tell them their score.

If warp was selected, it also indicates the time it took to answer the questions.

From that page the user has the option of replaying the game with a new set of random
questions or returning to the main play page to select a brand new game.
Not that it is intentional at this point that the user settings have been reset.


Making Up The Questions
It turns out its hard to make up questions even if you are a Trekkie.
So I enlisted the help of the following websites and used some of their
questions outright or modified them.
  www.allthetests.com
  www.triviachamp.com/Star-Trek-The-Original-Series-Quiz.php
  www.triviaplaying.com/star-trek-trivia-219.htm
  www.funtrivia.com

Pictures and Images
I stole from the internet from the following sites
www.gettyimages.com/photos/star-trek
https://www.google.com/search?q=star+trek+pictures&espv=2&tbm=isch&tbo=u&source=univ&sa=X&sqi=2&ved=0ahUKEwiPk7Pj1ovTAhWkqlQKHcAVDU0Q7AkINA&biw=1161&bih=640

During debug session, Professor Buck provided a template for the setup of the controller that I used to get the pages working properly.


Known Issues
1.  I believe I have fixed this issue but when you refresh a game page while in Warp mode sometimes the time out come back as a huge number (i.e it was negative).  But I believe i fixed that since I haven't seen it lately.
2. I don't like the way the submit button bounces around.  That's a CSS thing and I didn't want to waste time on that.
3. The random selection of questions sometimes allows for repeat questions.  The solution to this is better handled at the database so I didn't bother to do any checking here.


Things I Would Improve On
1. Make it so that the score page shows what you got right and wrong.
2. Set up the Trekkie questions to be much harder.
3. Have different random pictures shown for each question rather than just the same one.
4. Make the Warp selection a timed selection such that you answer as many questions
as you can in a selected amount of time.
5. Have picture questions.  Something like show a picture of a communicator and ask What is this?
Most of these things would be better served by the utilization of a database, which is
why I didn't implement them in this assignment.
6. Randomize the answers.
