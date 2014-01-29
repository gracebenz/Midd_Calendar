//Name: Khi Hua Chou && Palmer Campbel
//Final Project
//Monday, May 13, 2013

import java.applet.*;
import java.awt.*;
import java.awt.event.*;

import javax.swing.event.MouseInputListener;
public class Drawing extends Applet implements ActionListener, Runnable{

	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	BoxCanvas c;
	Button StartButton, clearButton, UndoButton, PlayButton, ExitButton;
	Color myColor = new Color(102, 178, 255);

	public void init () {
		setFont(new Font("Comic Sans MS", Font.BOLD + Font.ITALIC,24)); // Font in game
		setLayout(new BorderLayout()); 
		setBackground(myColor);
		add("North", makeTopPanel());
		add("West", makeLeftPanel());
		add("Center", makeCenterPanel());

	}
	// creates Title to be displayed at top of game
	public Panel makeCenterPanel(){
		Panel p = new Panel();
		Image Rv = getImage(getDocumentBase(), "RedVic.png");
		Image Blue = getImage(getDocumentBase(), "Blue.png");
		Image Red = getImage(getDocumentBase(), "Red.png");
		Image Empty = getImage(getDocumentBase(), "Empty.png");
		Image Arrow = getImage(getDocumentBase(), "Arrow.png");
		Image Bv = getImage(getDocumentBase(), "BlueVic.png");
		Image Ob = getImage(getDocumentBase(), "Oback.png");   
		Image Blue_s = getImage(getDocumentBase(), "Blue_Selected.png");
		Image Red_s = getImage(getDocumentBase(), "Red_Selected.png");
		Image Empty_s = getImage(getDocumentBase(), "Empty_Selected.png");
		Image Arrow_s = getImage(getDocumentBase(), "Arrow_Selected.png");
		Image Bt = getImage(getDocumentBase(), "Blue_Turn.png");
		Image Rt = getImage(getDocumentBase(), "Red_Turn.png");
		Image Tie = getImage(getDocumentBase(), "Tie.png");
		Image Wc = getImage(getDocumentBase(), "Welcome.png");
		AudioClip beep = getAudioClip (getCodeBase(), "beep.au");
		AudioClip end = getAudioClip (getCodeBase(), "end.au");
		AudioClip no = getAudioClip (getCodeBase(), "no.au");
		c = new BoxCanvas(Blue, Red, Empty, Arrow, Rv, Bv, Ob, 
				Blue_s, Red_s, Empty_s, Arrow_s, Bt, Rt, Wc, Tie, beep, end, no);
		c.setSize(620, 490);
		c.setBackground(Color.yellow);
		c.addMouseMotionListener(c);
		c.addMouseListener(c);
		p.add(c);
		p.setSize(500, 500);
		return p;
	}
	public Panel makeTopPanel() {

		Panel p = new Panel();
		p.setLayout(new BorderLayout());

		Label north = new Label();
		north.setBackground(myColor);
		Label west = new Label();
		west.setBackground(myColor);
		Label east = new Label();
		east.setBackground(myColor);
		Label south = new Label();
		south.setBackground(myColor);
		Label center = new Label("Connect Four: The Vertical Four-in-a-Row Checkers Game");
		center.setAlignment(Label.CENTER);

		center.setBackground(Color.red);
		center.setForeground(Color.white);


		p.add("North", north);
		p.add("West", west);
		p.add("East", east);
		p.add("South", south);
		p.add("Center",center);

		return p;
	}

	public Panel makeLeftPanel() {
		// left panel of the GUI, incorporates a grid layout within a border layout
		Panel p = new Panel();
		Panel center = new Panel();

		p.setLayout(new BorderLayout());
		Color myColor = new Color(102, 178, 255);

		Label top = new Label();
		top.setBackground(myColor);
		Label middle1 = new Label();
		middle1.setBackground(myColor);
		Label middle2 = new Label();
		middle2.setBackground(myColor);
		Label bottom = new Label();
		bottom.setBackground(myColor);
		Label west = new Label();
		west.setBackground(myColor);
		Label east = new Label();
		east.setBackground(myColor);

		StartButton = new Button("Start");
		StartButton.setBackground(Color.red);
		StartButton.setForeground(Color.white);
		StartButton.addActionListener(this);
		clearButton = new Button("Reset");
		clearButton.setBackground(Color.red);
		clearButton.setForeground(Color.white);
		clearButton.addActionListener(this);

		ExitButton = new Button("Exit");
		ExitButton.setBackground(Color.red);
		ExitButton.setForeground(Color.white);
		ExitButton.addActionListener(this);
		p.add("West", west);
		p.add("East", east);
		p.add("Center",center);
		center.setLayout(new GridLayout(7,1));

		center.add(top);
		center.add(StartButton);
		center.add(middle1);
		center.add(clearButton);
		center.add(middle2);
		center.add(ExitButton);
		center.add(bottom);

		return p;
	}

	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == StartButton) {
			c.start();
		} else if (e.getSource() == clearButton) {
			c.clear();
		}
		else if(e.getSource() == ExitButton){
			c.exit();
		}
	}
	//needed to implement runnable
	public void run() {
		// TODO Auto-generated method stub

	}

}

class BoxCanvas extends Canvas implements MouseInputListener, Runnable  {

	// instance variables representing the game go here
	private static final long serialVersionUID = 1L;

	//size of pic
	int size = 70;
	Item z = new Item(6,7);
	int n = z.getColumn();
	AudioClip beep,end, no;
	Image Blue, Red, Empty, Arrow, Rv, Bv, Oback, Offscreen, 
	Bs, Rs, Es, As, Bt, Rt, Wc, Tie;
	Color myColor = new Color(102, 178, 255);    
	boolean turn = true; //decides the turn
	boolean play = true; //if game is still going on or not
	boolean bluewin = false; 
	boolean redwin = false;
	boolean start = false; //for the start button
	boolean mouseOver = false; //for the mouse moving over.
	Graphics g2;
	Dimension offscreensize;
	int col_in; //use to pass the current column number to other methods

	public BoxCanvas(Image cB, Image cR, Image cE, Image cA, Image cRv, Image cBv, 
			Image cOb, Image Blue_s, Image Red_s, Image Empty_s, Image Arrow_s, 
			Image Bluet, Image Redt, Image Welc , Image Tied, 
			AudioClip beeps,AudioClip ends,AudioClip nope) {
		// all the files needed
		Blue = cB;
		Red = cR;
		Empty = cE;
		Arrow = cA;
		Bv = cBv;
		Rv = cRv;
		Oback = cOb;
		Bs = Blue_s;
		Rs = Red_s;
		Es = Empty_s;
		As = Arrow_s;
		Bt = Bluet;
		Rt = Redt;
		Wc = Welc;
		Tie = Tied;
		beep = beeps;
		end = ends;
		no = nope;
	}

	// draw the board etc

	public void update(Graphics g){
		Dimension d = getSize();

		// initially (or when size changes) create new image 
		if ((Offscreen == null)
				|| (d.width != offscreensize.width)
				|| (d.height != offscreensize.height)) {
			Offscreen = createImage(d.width, d.height);
			offscreensize = d;
			g2 = Offscreen.getGraphics();
			g2.setFont(getFont());
		}

		// erase old contents:
		g2.setColor(getBackground());
		g2.fillRect(0, 0, d.width, d.height);

		//check if the game has started
		if(!start){
			g2.drawImage(Oback,0,0,this);

		}
		else {
			for (int i = 0; i<n; i++){
				int x = i*size ;
				int y = 0;

				//check if the mouse is over the column and in that case
				//switch the image to produce a highlight effect for the item
				//in that column
				if(i == col_in && mouseOver){
					g2.drawImage(As,x,y,this);
				}else{
					g2.drawImage(Arrow,x,y,this);
				}
			}

			// use double for loops to loop through the whole 2D array
			for (int i = 1; i < z.getMain().length +1; i++) {
				int y = i* size;
				for (int j = 0; j < z.getMain()[i-1].length ; j++) {
					int x = j * size ;

					//check if the mouse is over the column and in that case
					//switch the image to produce a highlight effect for the item in 
					//that column
					if(j == col_in && mouseOver){
						if (z.getMain()[i-1][j] == false)
							g2.drawImage(Es, x, y, this);
						else{
							if(z.getRed()[i-1][j] == true){
								g2.drawImage(Rs, x,y,this);
							}
							else{
								g2.drawImage(Bs, x,y,this);
							}
						}
					}else{
						if (z.getMain()[i-1][j] == false)
							g2.drawImage(Empty, x, y, this);
						else{
							if(z.getRed()[i-1][j] == true){
								g2.drawImage(Red, x,y,this);
							}
							else{
								g2.drawImage(Blue, x,y,this);
							}
						}
					}
				}
			}
		}
		rightside();
		// finally, draw the image on top of the old one
		g.drawImage(Offscreen, 0, 0, null);

	}

	//Manage the right side of the canvas
	public void rightside(){
		g2.drawRect(490, 0, 20, 490);
		g2.setColor(myColor);
		g2.fillRect(490, 0, 50, 490);

		if(!start){
			g2.drawImage(Wc, 510, 0, this);
		}
		else{

			if(play){
				if(turn){
					g2.drawImage(Rt, 510, 0, this);
				}
				else{
					g2.drawImage(Bt, 510, 0, this);
				}
			}else{
				if(redwin)
					g2.drawImage(Rv, 510, 0, this);
				else if (bluewin)
					g2.drawImage(Bv, 510, 0, this);
				else{
					g2.drawImage(Tie, 510, 0, this);
				}

			}	

		}
	}



	public void paint(Graphics g) {
		update(g);
	}

	// handle mouse events

	// get the point where the mouse is over
	public void mouseMoved(MouseEvent event) {
		Point p = event.getPoint();
		int x = p.x;
		int k = x / size;
		mouseOver = true;
		col_in = k;
		repaint();
	}

	//see if the mouse exit the canvas
	public void mouseExited(MouseEvent event) { 
		mouseOver = false;
		repaint();
	}


	public void mousePressed(MouseEvent event) {
		// check if still playing
		if (!play){
			no.play();
		}
		else{
			//check to see if start button is pressed
			if(start){

				Point p = event.getPoint();
				// check if clicked in box area

				int x = p.x;
				int y = p.y;


				if (x >= 0 && x < n*size &&
						y >= 0 && y <n*size) {
					beep.play();
					int k = x / size;
					//select the column (k) and update the game
					select(k);
				}
			}
			repaint();
		}

	}

	//methods for the buttons in the applet
	//start button - click to start the game
	public void start(){
		start = true;
		repaint();
	}

	//exit button - click to return to instruction page
	public void exit() {
		clear();
		start = false;
		repaint();
	}

	//clear - reset the game
	public void clear() {
		z = new Item(6,7);
		turn = true;
		play = true;
		bluewin = false;
		redwin = false;

		repaint();
	}


	//select the column (x) and update the board
	public void select(int x){
		//check who's turn it is - true = red, false = blue
		if(turn){
			//check if it is full and switch the turn accordingly. If it is full
			// do not switch turn
			if(!z.isfull(x)){
				z.add(x, "red");
				repaint();

				boolean[][] red = z.getRed();
				//check to see if something was added (the ifadded() method returns
				//the row of the added pieces if something is added)
				//and then if there is a win from the move
				if(z.ifadded() != -1){
					if(win(red, z.ifadded(), x)){
						redwin = true;
					}
				}



				turn = !turn;
			}
		}
		else{
			//check if it's full for blue's turn as well

			if(!z.isfull(x)){
				z.add(x, "blue");
				repaint();
				boolean[][] blue = z.getBlue();

				//check to see if something was added (the ifadded() method returns
				//the row of the added pieces if something is added)
				//and then if there is a win from the move
				if(z.ifadded() != -1){
					if(win(blue, z.ifadded(), x)){

						bluewin = true;
					}

				}


				turn = !turn;
			}
		}
		// check if the game has ended, that is = either the tied, blue win or red win
		if(redwin|| bluewin || tied(z.getMain())){
			//make play false
			play = false;

			//play the end audio
			end.play();

		}
	}

	//Note: all count...true function base on recursion
	//count the number of true to the right
	public static int count_hor_right(boolean[][] x, int row, int col){
		if(col == x[row].length -1){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int col2 = col+1;
				return 1+ count_hor_right(x, row, col2);
			}
		}
	}


	//count the number of true to the left of the piece
	public static int count_hor_left(boolean[][] x, int row, int col){
		if(col == 0){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int col2 = col-1;
				return 1+ count_hor_left(x, row, col2);
			}
		}
	}

	//use the count left and right to see if there is a win horizontally
	public static boolean win_hor(boolean[][] x, int row, int col){
		int col1= col+1;
		int col2 = col-1;
		//check if it is column is 0 so we only need to count right
		if(col==0){
			if(count_hor_right(x,row,col1)>=3) 
				return true;
			else 
				return false;
		}
		//check if it is column is max so we only need to count left
		else if(col == x[row].length-1){
			if(count_hor_left(x,row,col2)>=3) return true;
			else return false;

		}
		else{
			//otherwise, use recursion to check
			if((count_hor_left(x, row, col2) + count_hor_right(x, row,col1 ))>=3){
				return true;
			}
			else{
				return false;	

			}

		}
	}

	//count the number of true below the piece

	public static int count_ver_down(boolean[][] x, int row, int col){
		//base case
		if(row == x.length -1){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		//use recursion
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int row2 = row+1;
				return 1+ count_ver_down(x, row2, col);
			}
		}
	}
	//count the number of true above the piece

	public static int count_ver_up(boolean[][] x, int row, int col){
		if(row == 0){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int row2 = row-1;
				return 1+ count_ver_up(x, row2, col);
			}
		}
	}
	//use the count up and down to see if there is a win vertically
	public static boolean win_ver(boolean[][] x, int row, int col){
		int row1= row+1;
		int row2 = row-1;

		//check if it is row is 0 so we only need to count down
		if(row == 0){
			if(count_ver_down(x,row1,col)>=3) return true;
			else return false;

		}
		//check if it is row is max so we only need to count up
		else if(row == x.length -1){
			if(count_ver_up(x,row2,col)>=3) return true;
			else return false;

		}
		else{

			if((count_ver_up(x, row2, col) + count_ver_down(x, row1,col ))>=3){
				return true;
			}
			else{
				return false;	

			}
		}
	}

	//count the number of true diagonally(1) downward to the piece

	public static int count_d1_down(boolean[][] x, int row, int col){
		if(row == x.length -1||col== x[row].length -1){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int row2 = row+1;
				int col2 = col+1;
				return 1+ count_d1_down(x, row2, col2);
			}
		}
	}

	//count the number of true diagonally(1) upward to the piece

	public static int count_d1_up(boolean[][] x, int row, int col){
		if(col == 0||row==0){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int row2 = row-1;
				int col2 = col-1;
				return 1+ count_d1_up(x, row2, col2);
			}
		}
	}

	//use the count diagonal1 up and down to see if there is a win diagonally
	//( diagonal 1 direction)
	// diagonal 1 direction:
	//     \
	//	    \
	//	     \
	//	      \
	//         \
	public static boolean win_d1(boolean[][] x, int row, int col){
		int row1= row+1;
		int row2 = row-1;
		int col1 = col+1;
		int col2 = col-1;

		//check if it is at the bottom left or the top right
		//because in that case, the diagonal1 would definitely 
		//return a false since there is no other piece in the diagonal 1 direction.
		if ((col ==0 && row == x.length-1) ||(col == x[row].length -1 && row == 0)){
			return false;
		}

		//check if it is at the top edge or at the left edge
		//so that it means you only need to count
		// downwards (in diagonal 1 direction)

		else if(col==0|| row == 0){
			if(count_d1_down(x,row1,col1)>=3) return true;
			else return false;

		}

		//check if it is at the bottom edge or right edge
		//so that is means you only need to count upwards (in diagonal 1 direction)
		else if(row == x.length -1 || col == x[row].length-1){
			if(count_d1_up(x,row2,col2)>=3) return true;
			else return false;

		}

		else{
			if((count_d1_up(x, row2, col2) + count_d1_down(x, row1,col1 ))>=3){
				return true;
			}
			else{
				return false;	

			}
		}
	}

	//count the number of true diagonally(2) downward to the piece

	public static int count_d2_down(boolean[][] x, int row, int col){
		if(row == x.length -1||col==0){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int row2 = row+1;
				int col2 = col-1;
				return 1+ count_d2_down(x, row2, col2);
			}
		}
	}

	//count the number of true diagonally(2) upward to the piece

	public static int count_d2_up(boolean[][] x, int row, int col){
		if(col == x[row].length -1||row==0){
			if(x[row][col] == false){
				return 0;
			}
			else{
				return 1;

			}
		}
		else {
			if(x[row][col] == false){
				return 0;
			}
			else{
				int row2 = row-1;
				int col2 = col+1;
				return 1+ count_d2_up(x, row2, col2);
			}
		}
	}

	//use the count diagonal2 up and down to see if there is a win diagonally
	//( diagonal 2 direction)
	// diagonal 2 direction:
	//        /
	//	     /
	//	    /
	//	   /
	//    /
	public static boolean win_d2(boolean[][] x, int row, int col){
		int row1= row+1;
		int row2 = row-1;
		int col1 = col-1;
		int col2 = col+1;

		//check if it is at the bottom right or the top left
		//because in that case, the diagonal2 would definitely 
		//return a false since there is no other piece in the diagonal 2 direction.

		if ((col ==0 && row == 0) ||(col == x[row].length -1 && row == x.length -1)){
			return false;
		}

		//check if it is at the bottom edge or at the left edge
		//so that it means you only need to count
		// upwards (in diagonal 2 direction)

		else if(col==0||row==x.length -1){
			if(count_d2_up(x,row2,col2)>=3) return true;
			else return false;

		}

		//check if it is at the top edge or right edge
		//so that is means you only need to count downwards (in diagonal 2 direction)
		else if(row == 0|| col ==x[row].length -1){
			if(count_d2_down(x,row1,col1)>=3) return true;
			else return false;

		}

		else{
			if((count_d2_up(x, row2, col2) + count_d2_down(x, row1,col1 ))>=3){
				return true;
			}
			else{
				return false;	

			}

		}
	}

	//return a win by puttin all the checks together
	public static boolean win(boolean[][] x, int row, int col){
		return (win_d2(x, row, col) ||win_d1(x, row, col) 
				|| win_hor(x, row, col) || win_ver(x, row,col));
	}

	//check to see if there is a tie
	public static boolean tied(boolean[][] x){
		boolean answer = true;
		// look to see if there is any space left in the main boolean array
		for(int i =0; i< x.length ; i++){
			for(int j =0; j<x[0].length; j++){
				if(x[i][j] == false){
					answer = false;
				}
			}

		}
		if(answer)
			return true;
		else{
			return false;
		}
	}

	// need these also because we implement a MouseListener
	public void mouseReleased(MouseEvent event) { }
	public void mouseClicked(MouseEvent event) { }
	public void mouseEntered(MouseEvent e) { }
	public void mouseDragged(MouseEvent arg0) { }
	public void run() { }
}