from tkinter import *
from functools import partial # to prevent unwanted windows
import random
import operator


class Start:
    def __init__(self, parent):

        # gui for main menu with difficulty selection and instructions
        self.menu_frame = Frame(padx=10, pady=10)
        self.menu_frame.grid()

        # quiz header (row 0)
        self.quiz_label = Label(self.menu_frame, text="super hard math quiz (IMPOSSIBLE)", font="arial 19 bold")
        self.quiz_label.grid(row=0)

        # difficulty selection buttons (row 1 & 2)
        self.choose_text = Label(self.menu_frame, text="choose your difficulty:", font="arial 12", pady=30)
        self.choose_text.grid(row=1)

        self.difficulty_box = Frame(self.menu_frame, padx=10, pady=50)
        self.difficulty_box.grid(row=2)

        self.easy_button = Button(self.difficulty_box, text="easy", font="arial 14", justify=CENTER, command=lambda: self.check_difficulty("easy"))
        self.easy_button.grid(row=0, column=0)

        self.normal_button = Button(self.difficulty_box, text="normal", font="arial 14", justify=CENTER, command=lambda: self.check_difficulty("normal"))
        self.normal_button.grid(row=0, column=1)

        self.hard_button = Button(self.difficulty_box, text="hard", font="arial 14", justify=CENTER, command=lambda: self.check_difficulty("hard"))
        self.hard_button.grid(row=0, column=2)

        # how to play and quit buttons (row 3)
        self.support_frame = Frame(self.menu_frame, padx=10, pady=10)
        self.support_frame.grid(row=3)

        self.howplay_button = Button(self.support_frame, text="how to play", font="arial 15 bold", command=self.to_help)
        self.howplay_button.grid(row=0, column=0)

        self.quit_button = Button(self.support_frame, text="quit", font="arial 15 bold")
        self.quit_button.grid(row=0, column=1)

    # difficulty functions

    def to_quiz(self, difficulty):
        Quiz(self, difficulty)
        # hide start up window
        root.withdraw()

      



    # support window function
    def to_help(self):

        Support(self)



class Support:
    def __init__(self, partner):

        # disable help button
        partner.howplay_button.config(state=DISABLED)

        # sets up child window (ie: help box)
        self.support_box = Toplevel()

        # if users press cross at top, closes help and 'releases' help button
        self.support_box.protocol('WM_DELETE_WINDOW', partial(self.close_help, partner))

        # set up gui frame
        self.help_frame = Frame(self.support_box, width=300)
        self.help_frame.grid()

        # set up help heading (row 0)
        self.how_heading = Label(self.help_frame, text="how to play", font="arial 14 bold")
        self.how_heading.grid(row=0, pady=10)

        self.help_text = Label(self.help_frame, text="choose the difficulty you want, finish the questions by filling in the blank box and clicking submit.", justify=LEFT, wrap=400, padx=10, pady=5)
        self.help_text.grid(row=1)

        # text showing each of the difficulties and examples (row 2)
        self.difficulty_frame = Frame(self.support_box, padx=10, pady=10, bg="#d1d1d1")
        self.difficulty_frame.grid(row=2, padx=10, pady=10)

        self.difficulties_text = Label(self.difficulty_frame, text="difficulties:", font="arial 12 bold", bg="#d1d1d1")
        self.difficulties_text.grid(row=0, pady=10)

        self.difficulty_examples = Label(self.difficulty_frame, text="easy: addition and subtraction, digits will always be from 1 to 15 (e.g. 7 + 4, 14 - 8).\n\nmedium: addition, subtraction, multiplication and divison. addition and subtraction \ndigits will always be from 1 to 50 (e.g. 34 +12, 34 - 19). multiplication and division digits \nwill always be from 1 to 12 (e.g. 8 x 3, 6 / 2).\n\nhard: multiplication and division only. multiplication digits will always be from  50 to \n500 (e.g. 174 x 411). divison digits will always be from 1 to 200 (e.g. 196 / 28).\n\nyou'll be given 10 questions. good luck", bg="#d1d1d1")
        self.difficulty_examples.grid(row=1, pady=20)

        # dismiss button (row 3)
        self.dismiss_btn = Button(self.support_box, text="dismiss", width=10, bg="#660000", fg="white", font="arial 15 bold", command=partial(self.close_help, partner))
        self.dismiss_btn.grid(row=3, pady=20)

    def close_help(self, partner):
        self.support_box.destroy()
        partner.howplay_button.config(state=NORMAL)   


class Quiz:
    def __init__(self, partner, difficulty):
        print(difficulty)
        
        # take count of the number of questions
        quest_num = 0

        # quiz gui
        self.quiz = Toplevel()
        self.quiz_frame = Frame(self.quiz, padx=10, pady=10) 
        self.quiz_frame.grid()

        # question number
        self.question_header = Label(self.quiz_frame, text="question {}".format(quest_num), font='arial 18 bold', justify=CENTER)
        self.question_header.grid(row=0, pady=20)
              
        # box that displays question
        self.question_box = Label(self.quiz_frame, text="", font="arial 16", justify=CENTER, bg="grey")
        self.question_box.grid(row=1, padx=10, pady=20)

        # answer input box
        self.answer_frame = Frame(self.quiz_frame, padx=10, pady=50)
        self.answer_frame.grid(row=2)

        self.help_text = Label(text="type answer in the box below and click submit.", font="arial 10", fg="grey")
        self.help_text.grid(row=0, padx=5, pady=5)

        self.answer_entry = Entry(self.answer_frame, font="Arial 19 bold", width=10)
        self.answer_entry.grid(row=1, column=0)

        self.submit_button = Button(self.answer_frame, font="Arial 14 bold", text="submit")
        self.submit_button.grid(row=0, column=1)



# main routine
if __name__ == "__main__":
    root = Tk()
    root.title("super hard math quiz (IMPOSSIBLE)")
    something = Start(root)
    root.mainloop()